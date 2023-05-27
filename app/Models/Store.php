<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    
    protected $table = 'stores';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'id',
        'store_code',
        'store_code_new',
        'store_name',
        'store_phone',
        'lat',
        'long',
        'province_id',
        'address',
        'asm_name',
        'asm_phone',
        'survey_group_ids',
        'store_note',
        'distributor',
        'region',
        'status',
        'id_deleted',
        'created_at',
        'level',
        'city_name'
    ];
    protected $hidden = [
    ];

    public function plans() {
        return $this->hasMany('App\Models\Plan','store_id','id');
    }
}
