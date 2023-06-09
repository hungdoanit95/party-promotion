<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;
use App\Exports\ReportExport;

use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Alignment;
use App\Models\Plan;
use App\Models\PlanImage;
use App\Models\PlanSurvey;
use App\Models\Reasons;
use App\Models\SurveyQuestion;
use Illuminate\Support\Facades\Log;

use PhpOffice\PhpPresentation\Shape\Drawing\File;



class DownloadController extends Controller
{
    public function downloadPlanPage(){
        return view('plan-download');
    }
    public function downloadPartyPage(){
        return view('party-download');
    }
    public function downloadPlanPartyPage(){
        return view('plan-party-download');
    }
    public function downloadUserPage(){
        return view('user-download');
    }
    public function downloadStorePage(Request $request){
        return view('store-download',[
            'key_search' => isset($request->key_search)?$request->key_search:''
        ]);
    }
    public function downloadReportPlan(Request $request){
        $filter = array();
        if(isset($request->plan_status)){
            $filter['status'] = $request->plan_status;
        }
        if(isset($request->user_id)){
            $filter['user_id'] = $request->user_id;
        }
        if(isset($request->plan_qc)){
            $filter['plan_qc'] = $request->plan_qc;
        }
        if(isset($request->start_date)){
            $filter['start_date'] = $request->start_date;
        }
        if(isset($request->end_date)){
            $filter['end_date'] = $request->end_date;
        }
        if(isset($request->plan_name)){
            $filter['plan_name'] = $request->plan_name;
        }
        if(isset($request->route_plan)){
            $filter['route_plan'] = $request->route_plan;
        }
        $file_name = 'Plan-List-'.date('Ymd-His').'.xlsx';
        return Excel::download(new ReportExport($filter), $file_name,ExcelExcel::XLSX);
    }
    public function downloadPowerPoint(Request $request){
        $objPHPPowerPoint = new PhpPresentation();

        // Create slide
        $currentSlide = $objPHPPowerPoint->getActiveSlide();

        // Create a shape (drawing)
        $shape = $currentSlide->createDrawingShape();
        $shape->setName('Logo')
            ->setDescription('Logo')
            ->setPath(__DIR__.'/../../../resources/cps-retail.png')
            ->setHeight(60)
            ->setOffsetX(10)
            ->setOffsetY(10);
        $shape->getShadow()->setVisible(true)
                        ->setDirection(45)
                        ->setDistance(10);
        $shape = $currentSlide->createDrawingShape();
        $shape->setName('Logo Sabeco')
            ->setDescription('Logo Sabeco')
            ->setPath(__DIR__.'/../../../resources/Logo-Sabeco-Red.png')
            ->setHeight(60)
            ->setOffsetX(150)
            ->setOffsetY(10);
        $shape->getShadow()->setVisible(true)
                        ->setDirection(45)
                        ->setDistance(10);
        // Create a shape (text)
        $shape = $currentSlide->createRichTextShape()
            ->setHeight(100)
            ->setWidth(800)
            ->setOffsetX(10)
            ->setOffsetY(120);
        // $shape->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_CENTER );
        $textRun = $shape->createTextRun('BÁO CÁO FORWARD LEAP');
        $textRun->getFont()->setBold(true)
                        ->setSize(40)
                        ->setColor( new Color( 'FFE06B20' ) );
        $shape1 = $currentSlide->createRichTextShape()
            ->setHeight(100)
            ->setWidth(800)
            ->setOffsetX(10)
            ->setOffsetY(200);
        // $shape1->getActiveParagraph()->getAlignment(); 
        $textRun1 = $shape1->createTextRun('BÁO CÁO HÌNH ẢNH');
        $textRun1->getFont()->setBold(true)
                        ->setSize(40)
                        ->setColor( new Color('FFE06B20') );
        $data_export = Plan::leftjoin('plan_images','plan_images.plan_id','plans.id')
        ->leftjoin('stores','stores.id','plans.store_id')
        ->leftjoin('plan_surveys','plan_surveys.plan_id','plans.id')
        ->select(
            'plans.id',
            'plans.store_id',
            'plans.reason_id',
            // 'plan_surveys.data_json',
            'plan_images.link_image',
            'stores.store_name',
            'stores.store_code'
        );
        if(!empty($request->route_plan)){
            $data_export = $data_export->where('route_plan',$request->route_plan);
        }else{
            return 'Vui lòng chọn tháng để xuất'; die;
        }
        if(!empty($request->user_id)){
            $data_export = $data_export->where('plans.user_id',$request->user_id);
        }else{
            return 'Vui lòng chọn User_id'; die;
        }
        // if(!empty($request->start_date)){
        //     $data_export = $data_export->where('plans.date_start',$request->start_date);
        // }
        // if(!empty($request->end_date)){
        //     $data_export = $data_export->where('plans.date_end',$request->end_date);
        // }
        // $data_export = $data_export->whereNotNull('plan_images.link_image');
        // if(!empty($request->plan_qc)){
        //     $data_export = $data_export->leftjoin(DB::raw('SELECT * FROM plan_qc GROUP BY plan_id'),function($join){
        //         $join->on('plans.id', '=', 'plan_qc.plan_id');
        //     });
        // }
        if(!empty($request->plan_name)){
            $data_export = $data_export->where('plan_name',$request->plan_name);
        }
        if(!empty($request->plan_status)){
            $check_status = $request->plan_status;
            switch($check_status){
                case 1: case 2:
                    $data_export = $data_export->where('plans.status',$check_status);
                    break;
                case 3:
                    $data_export = $data_export->where('plans.status',0);
                    $data_export = $data_export->whereNotNull('time_checkin');
                    break;
                case 4:
                    $data_export = $data_export->whereIn('plans.status',[1,2]);
                    break;
                default:
                    break;
            }
        }
        $data_export = $data_export->get();
        $reasons = Reasons::whereNotNull('reason_id')->select('reason_id','reason_name')->get();
        $reason_datas = array();
        foreach($reasons as $reason){
            $reason_datas[$reason->reason_id] = $reason->reason_name;
        }
        $questions = SurveyQuestion::whereNotNull('survey_id')->select('survey_id','survey_name')->get();
        $survey_datas = array();
        foreach($questions as $question){
            $survey_datas[$question->survey_id] = $question['survey_name'];
        }
        $position_x = 10;
        $new_slide = $currentSlide;
        $old_store_id = 0;
        $count_store = 0;
        $last_store_code = '';
        foreach($data_export as $key => $dt){
            $source_url = __DIR__."/../../../storage/app/".$dt->link_image;
            if(!empty($dt->link_image)&&is_file(__DIR__."/../../../storage/app/".$dt->link_image)){
                // list($width_img, $height_img) = getimagesize(__DIR__."/../../../storage/app/".$dt->link_image);
                // $size_image = filesize(__DIR__."/../../../storage/app/".$dt->link_image);
                // $check_size = $size_image / 1048576;
                // if($check_size > 1.5){
                //     $destination_url = __DIR__."/../../../storage/app/fix/".$dt->link_image;
                //     // header('Content-Type: image/jpeg');
                //     // $newwidth = $width_img * 0.5;
                //     // $newheight = $height_img * 0.5;
                //     $entity_image = explode('/',$dt->link_image);
                //     $name_image_crr = end($entity_image);
                //     $remove_last_element = array_pop($entity_image);
                //     $new_path = implode('/',$entity_image);
                //     // if (!file_exists($destination_url)) {
                //     //     mkdir(__DIR__."/../../../storage/app/fix/".$new_path, 0777, true);
                //     // }
                //     $info_image = getimagesize(__DIR__."/../../../storage/app/".$dt->link_image);
                //     Log::debug($info_image);
                //     $quality = 50;
                //     if ($info_image['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source_url);
                //     elseif ($info_image['mime'] == 'image/gif') $image = imagecreatefromgif($source_url);
                //     elseif ($info_image['mime'] == 'image/png') $image = imagecreatefrompng($source_url);
                //     imagejpeg($image, $source_url, $quality);
                // }
                if($dt->store_code != $last_store_code){
                    $last_store_code = $dt->store_code;
                    $count_store += 1;
                }
                if($key % 2 == 0 || $old_store_id != $dt['store_id'] || $old_store_id == 0){
                    $new_slide = $objPHPPowerPoint->createSlide();
                    $old_store_id = $dt['store_id'];
                }
                $new_slide->setName($count_store.'. '.$dt->store_name);
                $shape_title = $new_slide->createRichTextShape()
                ->setHeight(100)
                ->setWidth(600)
                ->setOffsetX(35)
                ->setOffsetY(35);
                // $shape_title->getActiveParagraph()->getAlignment()->setHorizontal( Alignment::HORIZONTAL_LEFT );
                $label_store = $shape_title->createTextRun($count_store.'. '.$dt->store_name . ' - ' . $dt->store_code);

                $data_text = '';

                // $data_dejson = isset($dt->data_json)?json_decode($dt->data_json):'';
                // if(!empty($data_dejson)){
                //     foreach($data_dejson as $dt_json){
                //         $data_text .= $survey_datas[$dt_json->survey_id].': '.$dt_json->value.' / ';
                //     }
                // }
                if(!empty($reason_datas[$dt->reason_id])){
                    $data_text = 'Lý do KTC: '. $reason_datas[$dt->reason_id];
                }else{
                    $data_text = 'Kết quả: Thành công';
                }
                $label_store->getFont()->setBold(true)
                                ->setSize(12)
                                ->setColor( new Color( 'FFE06B20' ) );
                $shape_title2 = $new_slide->createRichTextShape()
                ->setHeight(100)
                ->setWidth(600)
                ->setOffsetX(35)
                ->setOffsetY(70);
                $label_data = $shape_title2->createTextRun($data_text);
                $label_data->getFont()->setBold(true)
                                ->setSize(12)
                                ->setColor( new Color( 'FFE06B20' ) );
                if(!empty($dt->link_image)&&is_file(__DIR__."/../../../storage/app/".$dt->link_image)){
                    if($key % 2 == 0){
                        $position_x = 480;
                    }else{
                        $position_x = 10;
                    }
                    // $new_shape = $new_slide->createDrawingShape();
                    // $new_shape->setName($dt->store_name)
                    //     ->setDescription($dt->store_name)
                    //     ->setPath(__DIR__."/../../../storage/app/".$dt->link_image)
                    //     ->setWidth(200)
                    //     ->setOffsetX($position_x)
                    //     ->setOffsetY($position_y);

                    $shape = new File();
                    $shape->setName('Image'.$key)
                        ->setDescription($count_store.'. '.$dt->store_name)
                        ->setPath(__DIR__."/../../../storage/app/".$dt->link_image)
                        ->setWidth(450)
                        ->setOffsetX($position_x)
                        ->setOffsetY(180);
                    $new_slide->addShape($shape);
                }
            }
        }

        $oWriterPPTX = IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        $link_file = __DIR__ . "/../../../resources/sample.pptx";
        $oWriterPPTX->save($link_file);
        $oWriterODP = IOFactory::createWriter($objPHPPowerPoint, 'ODPresentation');
        $oWriterODP->save(__DIR__ . "/../../../resources/sample.odp");
        $headers = array(
            'Content-Type: application/pptx',
          );

        return Response::download($link_file, 'Hinh-anh-bao-cao'.time().'.pptx', $headers);
    }   
}
