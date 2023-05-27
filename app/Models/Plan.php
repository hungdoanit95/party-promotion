<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PlanImage;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'plans';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'store_id',
        'store_code',
        'old_store_id',
        'store_name',
        'store_phone',
        'user_id',
        'route_plan',
        'date_start',
        'date_end',
        'plan_name',
        'note_admin',
        'plan_qc_code',
        'date_upload',
        'created_at'
    ];
    protected $hidden = [
    ];

    public function planLists() {
        return $this->hasMany('App\Models\PlanImage','plan_id','id');
    }
    public function planStore(){
        return $this->hasOne('App\Models\Store','id','store_id');
    }
}
