@extends('components.layout')
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
<style>
    .pagination svg{
        width: 20px;
    }
    .pagination > nav{
        display: flex;
        width: 100%;
        justify-content: space-between;
    }
    .pagination > nav > div:first-child span.px-4,.pagination > nav > div:first-child a{
        font-size: 12px;
        padding: 8px 15px !important;
    }
    .pagination > nav > div:last-child > div:last-child a,.pagination > nav > div:last-child > div:last-child span.px-4{
        font-size: 12px;
        padding: 8px 15px !important;
    }
    #inputPlanName,.ip-datetime,.btn-clear-filter{
      margin-top: 20px;
    }
    table{
      margin-top: 40px;
    }
    .btn-search-plan, .btn-clear-filter{
      height: 40px;
      width: 48px;
      margin: 20px 10px;
    }
    #inputUser_chosen a.chosen-single{
      position: relative;
      display: block;
      overflow: hidden;
      padding: 0 0 0 8px;
      height: 38px;
      border: 1px solid #ccc;
      border-radius: 5px;
      background: #fff;
      color: #444;
      text-decoration: none;
      white-space: nowrap;
      box-shadow: unset;
      line-height: 38px;
      margin-top: 10px;
    }
    .chosen-container-single .chosen-single div b{
      background-position: 0 9px;
    }
    .group-button{
      position: absolute;
      z-index: 2;
      opacity: 0;
      transition: all ease .4s;
      left: -100%;
      top: 50%;
      transform: translateY(-50%);
    }
    .card-body table tbody> tr:hover .group-button{
      opacity: 1;
      left: 0;
    }
</style>
@section('content')
@if(!empty($user_logged) && $user_logged['group_id'] == 10)
<script>
  $(window).ready(function(){
    $('body').addClass('toggle-sidebar');
    $('header .bi-list.toggle-sidebar-btn').hide();
  })
</script>
<style>
  .toggle-sidebar .sidebar, header .bi-list.toggle-sidebar-btn{
    display: none !important;
    left: -100% !important;
  }
</style>
@endif
    <div class="pagetitle">
      <h1>Danh sách plans</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#dashboard">Dashboard</a></li>
          <li class="breadcrumb-item">Plan Lists</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-3">
                  <input type="text" style="margin-top: 10px" class="form-control" id="search-global" placeholder="Gõ từ khoá và nhấn Enter..." />
                </div>
                <div class="col-lg-3">
                  <select id="inputUser" style="margin-top: 10px" class="form-select">
                    <option selected value="*">--- Nhân viên ---</option>
                    @foreach($users as $user)
                    <option {{ (!empty($params_search['user_id']) && $user->user_id == $params_search['user_id'])?"selected":""; }} value="{{ $user->user_id }}">{{ $user->username }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-3">
                  <select id="inputQC" style="margin-top: 10px" class="form-select">
                    <option {{ (isset($params_search['plan_qc']) && $params_search['plan_qc'] === '*')?"selected":""; }} value="*">--- QC/Chưa QC ---</option>
                    <option {{ (isset($params_search['plan_qc']) && $params_search['plan_qc'] === '1')?"selected":""; }} value="1">Chưa QC</option>
                    <option {{ (isset($params_search['plan_qc']) && $params_search['plan_qc'] === '2')?"selected":""; }} value="2">Đã QC</option>
                  </select>
                </div>
                <div class="col-lg-3">
                  <select id="inputState" style="margin-top: 10px" class="form-select">
                    <option {{ (isset($params_search['plan_status']) && $params_search['plan_status'] === '*')?"selected":""; }} value="*">--- Trạng thái ---</option>
                    <option {{ (isset($params_search['plan_status']) && $params_search['plan_status'] === '0')?"selected":""; }} value="0">Chưa làm</option>
                    <option {{ (isset($params_search['plan_status']) && $params_search['plan_status'] === '3')?"selected":""; }} value="3">Đang làm</option>
                    <option {{ (isset($params_search['plan_status']) && $params_search['plan_status'] === '4')?"selected":""; }} value="4">Đã làm</option>
                    <option {{ (isset($params_search['plan_status']) && $params_search['plan_status'] === '1')?"selected":""; }} value="1">Thành Công</option>
                    <option {{ (isset($params_search['plan_status']) && $params_search['plan_status'] === '2')?"selected":""; }} value="2">KTC</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3">
                  <select id="inputPlanName" class="form-select">
                    <option {{ (((isset($params_search['plan_status']) && $params_search['plan_status'] === '*'))) ?"selected":""; }} value="*">--- PlanName ---</option>
                    @foreach($plan_names as $plan_name)
                    <option {{ (isset($params_search['plan_name']) && $params_search['plan_name'] === $plan_name->plan_name)?"selected":""; }} value="{{ $plan_name->plan_name }}">{{ $plan_name->plan_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-sm-3">
                  <input type="datetime" id="start-date-ip" value="{{ (isset($params_search['start_date']))?$params_search['start_date']:""; }}" class="form-control ip-datetime" placeholder="Bắt đầu từ..." />
                </div>
                <div class="col-sm-3">
                  <input type="datetime" id="end-date-ip" value="{{ (isset($params_search['end_date']))?$params_search['end_date']:""; }}" class="form-control ip-datetime" placeholder="...ngày kết thúc" />
                </div>
                <div class="col-sm-3">
                  <select id="route-plan-ip" name="route_plan" class="form-select form-control" style="margin-top: 20px">
                    <option value="*">--- Tháng ---</option>
                    @foreach($route_plans as $plan)
                      <option {{ (isset($params_search['route_plan']) && $params_search['route_plan'] == $plan->route_plan )?"selected":""; }} value="{{ $plan->route_plan }}">{{ $plan->route_plan }}</option>
                    @endforeach            
                  </select>
                </div>  
              </div>
              <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3 text-right" style="text-align: right">
                  <button class="btn-search-plan btn btn-success"><i class="bi bi-search"></i></button>
                  <button class="btn-clear-filter btn btn-default" style="border: 1px solid #ccc" onclick="clearFilter()"><i class="bi bi-eraser"></i></button>
                </div>
              </div>
              @if($list_plans)
              <div style="overflow-x: auto;display:inline-block;width: 100%;overflow-y: hidden;padding: 10px 0;">
              <table class="table" style="min-width: 900px">
                    <thead>
                    <tr>
                        <th scope="col">Hình</th>
                        <th width="305" scope="col">Tên CH</th>
                        <th width="190" scope="col">Plan name / Kết quả</th>
                        <th width="140" scope="col">NV thực hiện</th>
                        <th width="135" scope="col">Ngày</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($list_plans as $key => $plan)
                          @if(!empty($plan))
                            <tr id="row-plan-<?= $plan->plan_id; ?>" style="font-size: 14px; position:relative;overflow: hidden;">
                                <td scope="row" style="position:relative">
                                  <div class="group-button">
                                    @if(!empty($user_logged) && in_array($user_logged['group_id'],array(1,2,3,4,5)))
                                      <button class="btn btn-danger" id="btn-delete-plan" type="button" onclick="delPlan(<?= $plan->plan_id; ?>)"><i class="bi bi-trash3"></i></button>
                                    @endif
                                  </div>  
                                  <a href="{{ !empty($plan_image_dt[$plan->plan_id])?'/storage/app/'.$plan_image_dt[$plan->plan_id]:asset('assets/img/store.jpg')}}" class="td-image" target="_blank"><img width="120" style="border-radius: 5px; max-height: 100px; object-fit: cover;" src="{{ !empty($plan_image_dt[$plan->plan_id])?'/storage/app/'.$plan_image_dt[$plan->plan_id]:asset('assets/img/store.jpg')}}" /></a>
                                </td>
                                <td>
                                    <span style="font-size: 13px">Asm: {{ $plan->store_code }}</span> <br/>
                                    <b>{{ $plan->store_name }} </b>
                                    <hr style="margin: 5px 0; ">
                                    <span style="font-size: 13px">Note: {{ $plan->address }}</span>
                                    <span style="font-size: 13px">Note: {{ $plan->store_note }}</span>
                                </td>
                                <td>
                                  {{ $plan->plan_name }} <br/>
                                  Trạng thái: {{ $plan->plan_status == 0 ? (((int)$plan->time_checkin >= 2022)?'Đang làm':'Chưa làm') : ($plan->plan_status == 1? 'Thành công' : 'KTC')}} <br />
                                  {!! !empty($plan_qc[$plan->plan_id])?'<p class="text-success font-weight-bold mb-0"><i class="bi bi-check2-circle"></i> Đã Qc</p>':'' !!}
                                  {!! (isset($plan->result_plan) && $plan->result_plan == 'Đạt')?'Kết quả: '.'<span class="text-success">'.$plan->result_plan.'</span>' : 'Kết quả: '.'<span class="text-danger">'.$plan->result_plan.'</span>'  !!}
                                </td>
                                <td>
                                    {{ $plan->username }} <br/>
                                    {{ $plan->telephone }}
                                    <hr style="margin: 5px 0; ">
                                    <span style="font-size: 13px">Asm: {{ $plan->asm_name }}</span>
                                </td>
                                <td>
                                    Start: {{ $plan->date_start }} <br/>
                                    End: {{ $plan->date_end }}
                                </td>
                                <td>
                                    <a href="{{ url('/get-info-plan/'.$plan->plan_id) }}" target="_blank"><i class="bx bxs-edit" style="font-size: 25px; margin-top: 20px;"></i></a>
                                </td>
                            </tr>
                          @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $list_plans->links() }}
                </div>
              </div>
                @else if
                    <p>Không có dữ liệu!</p>
                @endif
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <script>
      $(document).ready(function() {
        $('table tbody .td-image').magnificPopup({
          type: 'image',
          closeOnContentClick: true,
          mainClass: 'mfp-img-mobile',
          image: {
            verticalFit: true
          }
        });
      });
    </script>
    <script>
      function delPlan(id_plan){
        if(confirm('Vui lòng xác nhận xoá plan này chứ? Tuy nhiên, Plan vẫn có thể khôi phục và lịch sử xoá sẽ bị ghi lại.')){
          $.ajax({
            url: "{{ route('delete.plan') }}",
            data: {
              "_token": "{{ csrf_token() }}",
              "plan_id": id_plan,
              "user_id": "{!! !empty($user_logged['user_id'])?$user_logged['user_id']:'' !!}",
            },
            method:'POST',
            dataType:'json',
            success: function(data){
              alert(data.message);
              if(data.status){
                $('#row-plan-'+id_plan).remove();
              }
            }
          });
        }
      }
    </script>
    <style>
      img.mfp-img{
        width: 800px;
      }
      .pagination > nav > div:last-child > div:last-child{
        display: flex;
      overflow: hidden;
      border-top: 1px solid #ccc;
      border-bottom: 1px solid #ccc;
      color: #ccc;
      }
      .pagination > nav > div:last-child > div:last-child a{
        padding: 5px 15px;
        color: #ccc;
      }
      .pagination > nav > div:last-child > div:last-child a:hover{
        color: #000;
      }
      .pagination nav span.inline-flex > span{
        display: inline-grid;
      }
      .pagination nav span.inline-flex > span > span{
        background: #10adde !important;
        margin: 0;
        overflow: hidden;
        color: #fff;
      }
      #btn-download-payroll{
        list-style-type: none;
        background-color: #2778b6;
        color: #efefef;
        line-height: 43px;
        height: 43px;
        padding: 0px;
        margin: 0px 0px 1px 0px;
        -webkit-transition: all 0.25s ease-in-out;
        -moz-transition: all 0.25s ease-in-out;
        -o-transition: all 0.25s ease-in-out;
        transition: all 0.25s ease-in-out;
        cursor: pointer;
        width: 140px;
        display: flex;
        color: #fff;
        align-items: center;
        justify-content: center;
        position: fixed;
        z-index: 999;
        right: 0;
        top: 50%;
        transition: all ease .4s;
        width: auto;
      }
      #btn-download-payroll i{
        width: 45px;
        display: inline-block;
        line-height: 40px;
        text-align: center;
        vertical-align: middle;
        transition: all ease .4s;
        font-size: 20px;
      }
      #btn-download-payroll span{
        padding: 0;
        font-size: 13px;
        width: 0;
        opacity: 0;
        display: block;
        overflow: hidden;
        transition: all ease .5s;
      }
      #btn-download-payroll:hover > span{
        display: block;
        padding: 0 10px;
        width: auto;
        opacity: 1;
        overflow: hidden;
        animation: showbtnDownload .5s ease;
        background-color: #3aa0ef;
      }
      @keyframes showbtnDownload {
        from {
          width: 0;
          opacity: 0;
          display: block;
          overflow: hidden;
          padding: 0;
        }
        to{
          padding: 0 10px;
          width: auto;
          opacity: 1;
          display: block;
          overflow: hidden;
        }
      }
      #btn-download-payroll.show span{
        animation: showbtn .4s ease-out;
      }
      @keyframes showbtn {
        from{
          opacity: 0;
          width: 0;
          display: none;
        }
        to{
          opacity: 1;
          display: block;
        }
      }
    </style>
    <button onclick="downloadExcel()" id="btn-download-payroll" class="btn btn-dark-success btn-md">
      <i class="bi bi-cloud-arrow-down"></i>
      <span>Tải Bc QC</span>
    </button>
    <button onclick="downloadPowerPoint()" id="btn-download-payroll" style="margin-top: 110px" class="btn btn-dark-success btn-md">
      <i class="bi bi-cloud-arrow-down"></i>
      <span>Tải Powerpoint</span>
    </button>
    <button onclick="reCalculation()" id="btn-download-payroll" style="margin-top: 55px" class="btn btn-dark-success btn-md">
    <i class="bi bi-arrow-clockwise"></i>
      <span>Tính lại kết quả</span>
    </button>
    <script>
      $('#inputUser').chosen();
    </script>
    <script>
      function reCalculation(){
        $.ajax({
          url: "{{ route('re.calculate.result') }}",
          method: "POST",
          data: {
            "_token": "{{ csrf_token() }}",
            "recalculation": 1
          },
          dataType: "JSON",
          success: function (data) {
            alert(data.message);
          }
        });
      }
    </script>
    <script>
      function downloadExcel() {
        let val_status = document.getElementById('inputState').value;
        let user_id = document.getElementById('inputUser').value;
        let plan_qc = document.getElementById('inputQC').value;
        let start_date = document.getElementById('start-date-ip').value;
        let end_date = document.getElementById('end-date-ip').value;
        let today = new Date().toISOString().slice(0, 10);
        let plan_name = document.getElementById('inputPlanName').value;
        let route_plan = document.getElementById('route-plan-ip').value;
        let url_download = "/download-report-plan?type=download-plan";
        if(val_status && val_status != '*'){
          url_download += "&plan_status="+val_status;
        }
        if(user_id && user_id != '*'){
          url_download += "&user_id="+user_id;
        }
        if(plan_qc && plan_qc != '*'){
          url_download += "&plan_qc="+plan_qc;
        }
        if(start_date && start_date != '*'){
          url_download += "&start_date="+start_date;
        }
        if(end_date && end_date != '*'){
          url_download += "&end_date="+end_date;
        }
        if(plan_name && plan_name != '*'){
          url_download += "&plan_name="+plan_name;
        }
        if(route_plan && route_plan != '*'){
          url_download += "&route_plan="+route_plan;
        }
        window.open(url_download);
      }
    </script>
    <script>
      function downloadPowerPoint(){
        let val_status = document.getElementById('inputState').value;
        let user_id = document.getElementById('inputUser').value;
        let plan_qc = document.getElementById('inputQC').value;
        let start_date = document.getElementById('start-date-ip').value;
        let end_date = document.getElementById('end-date-ip').value;
        let today = new Date().toISOString().slice(0, 10);
        let plan_name = document.getElementById('inputPlanName').value;
        let route_plan = document.getElementById('route-plan-ip').value;
        let url_download = "/download-powerpoint?type=powerpoint";
        if(val_status && val_status != '*'){
          url_download += "&plan_status="+val_status;
        }
        if(user_id && user_id != '*'){
          url_download += "&user_id="+user_id;
        }
        if(plan_qc && plan_qc != '*'){
          url_download += "&plan_qc="+plan_qc;
        }
        if(start_date && start_date != '*'){
          url_download += "&start_date="+start_date;
        }
        if(end_date && end_date != '*'){
          url_download += "&end_date="+end_date;
        }
        if(plan_name && plan_name != '*'){
          url_download += "&plan_name="+plan_name;
        }
        if(route_plan && route_plan != '*'){
          url_download += "&route_plan="+route_plan;
        }
        window.open(url_download);
      }
    </script>
    <script type="text/javascript">
      var url = window.location.href; 
      var ssl_check = window.location.protocol;
      if("http:" === ssl_check){ 
        if (location.hostname === "localhost" || location.hostname === "127.0.0.1"){
          var new_url = url.replace('http://127.0.0.1:8000/get-list-plans/','');
        }else{
          var new_url = url.replace('http://omafox.com/get-list-plans','');
        }
      }else if("https:" === ssl_check){
        if (location.hostname === "localhost" || location.hostname === "127.0.0.1"){
          var new_url = url.replace('https://127.0.0.1:8000/get-list-plans/','');
        }else{
          var new_url = url.replace('https://omafox.com/get-list-plans','');
        }
      }
      $(document).ready(function(){
        $('body').on('keyup','#search-global',function(e){
          val_search = $(this).val();
          $.ajax({
              type: 'GET',
              url: '{{ route("live.search") }}?'+window.location.search.substr(1),
              data: {
                'search': val_search,
                "_token": "{{ csrf_token() }}",
              },
              success:function(data){
                $('tbody').html(data);
              } 
          });
          if(val_search.length > 3){
            $('.pagination').hide();
          }else{
            $('.pagination').show();
          }
        })
        $('.btn-search-plan').click(function(){
          let key_search = $('#search-global').val();
          let user_id = $('#inputUser').val();
          let plan_qc = $('#inputQC').val();
          let val_status = $('#inputState').val();
          let plan_name = $('#inputPlanName').val();
          let start_date = $('#start-date-ip').val();
          let end_date = $('#end-date-ip').val();
          let route_plan = $('#route-plan-ip').val();
          var url_back = "/get-list-plans?type=search_plan_list";
          if(key_search != '' && key_search != null && key_search !== undefined && key_search != '*'){
            url_back += "&key_search="+key_search;
          }
          if(val_status != '' && val_status != null && val_status !== undefined && val_status != '*'){
            url_back += "&plan_status="+val_status;
          }
          if(user_id != '' && user_id != null && user_id != undefined && user_id != '*'){
            url_back += "&user_id="+user_id;
          }
          if(plan_qc != '' && plan_qc != null && plan_qc != undefined && plan_qc != '*'){
            url_back += "&plan_qc="+plan_qc;
          }
          if(start_date != '' && start_date != null && start_date != undefined && start_date != '*'){
            url_back += "&start_date="+start_date;
          }
          if(plan_name != '' && plan_name != null && plan_name != undefined && plan_name != '*'){
            url_back += "&plan_name="+plan_name;
          }
          if(end_date != '' && end_date != null && end_date != undefined && end_date != '*'){
            url_back += "&end_date="+end_date;
          }
          if(route_plan != '' && route_plan != null && route_plan != undefined && route_plan != '*'){
            url_back += "&route_plan="+route_plan;
          }
          window.location.href = url_back; 
        });
      });
    </script>
    <script>
      function clearFilter(){
        window.location.href='/get-list-plans';
      }
    </script>
    <script>
      jQuery('.ip-datetime').datetimepicker({
        datepicker:true,
        timepicker:false,
        format:'Y-m-d'
      });
    </script>
@endsection