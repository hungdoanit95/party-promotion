<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parties;

class PartyController extends Controller
{
    public function getParties(Request $request){
        $key_search = isset($request->key_search) ? rawurldecode($request->key_search) : '';
        if($key_search){
            $parties_data = Parties::where(function($query) use ($key_search){
                $query->where('party_code','LIKE','%'.$key_search.'%')
                ->orWhere('introducer_name','LIKE','%'.$key_search.'%')
                ->orWhere('introducer_phone','LIKE','%'.$key_search.'%')
                ->orWhere('party_host_name','LIKE','%'.$key_search.'%')
                ->orWhere('party_host_phone','LIKE','%'.$key_search.'%')
                ->orWhere('party_type','LIKE','%'.$key_search.'%')
                ->orWhere('party_level','LIKE','%'.$key_search.'%')
                ->orWhere('beer_type','LIKE','%'.$key_search.'%')
                ->orWhere('organization_date','LIKE','%'.$key_search.'%')   
                ->orWhere('organization_time','LIKE','%'.$key_search.'%')
                ->orWhere('province','LIKE','%'.$key_search.'%')
                ->orWhere('district','LIKE','%'.$key_search.'%')
                ->orWhere('ward','LIKE','%'.$key_search.'%')
                ->orWhere('street','LIKE','%'.$key_search.'%')
                ->orWhere('home_number','LIKE','%'.$key_search.'%')
                ->orWhere('notes','LIKE','%'.$key_search.'%')
                ->orWhere('distributor','LIKE','%'.$key_search.'%')
                ->orWhere('point_of_salename','LIKE','%'.$key_search.'%')
                ->orWhere('point_of_salephone','LIKE','%'.$key_search.'%')
                ->orWhere('user_id','LIKE','%'.$key_search.'%');
            })->where('status',1);
            $parties = $parties_data->orderByDesc('id')->paginate(50);
        }else{
            $parties = Parties::where('status', 1)->orderByDesc('id')->paginate(50);
        }
        return view('parties',[
            'parties_lists' => $parties,
            'key_search' => isset($request['key_search']) ? $request['key_search'] : ''
        ]);
    }
}
