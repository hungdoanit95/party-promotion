<?php

namespace App\Exports;

use App\Models\Store;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

class StoresExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $key_search = array();

    public function __construct($key_search = ''){
        $this->key_search = isset($key_search)?$key_search:'';
    }

    public function collection()
    {
        $key_search = isset($this->key_search) ? rawurldecode($this->key_search) : '';
        if($key_search){
            return Store::where(function($query) use ($key_search){
                $query->where('store_code','LIKE','%'.$key_search.'%')
                ->orWhere('store_code','LIKE','%'.$key_search.'%')
                ->orWhere('store_code_new','LIKE','%'.$key_search.'%')
                ->orWhere('store_name','LIKE','%'.$key_search.'%')
                ->orWhere('store_name_new','LIKE','%'.$key_search.'%')
                ->orWhere('store_phone','LIKE','%'.$key_search.'%')
                ->orWhere('store_phone_new','LIKE','%'.$key_search.'%')
                ->orWhere('address','LIKE','%'.$key_search.'%')
                ->orWhere('address_new','LIKE','%'.$key_search.'%')   
                ->orWhere('asm_name','LIKE','%'.$key_search.'%')
                ->orWhere('asm_phone','LIKE','%'.$key_search.'%');
            })->where('id_deleted',0)->get();
        }else{
            return Store::where('id_deleted', 0)->orderByDesc('id')->get();
        }
    }
}
