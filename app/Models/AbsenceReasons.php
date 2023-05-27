<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceReasons extends Model
{
    use HasFactory;
    
    protected $table = 'absence_reasons';
    protected $primaryKey = 'absence_reason_id';
    public $timestamps = true;

    protected $fillable = [
        'absence_reason_id',
        'reason_name',
        'sort_order'
    ];
    public function reasonLists() {
        return $this->hasMany('App\Models\Absences','absence_reason_id','absence_reason_id');
    }
}
