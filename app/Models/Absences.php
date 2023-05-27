<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absences extends Model
{
    use HasFactory;
    
    protected $table = 'absences';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'date_off',
        'user_id',
        'absence_reason_id',
        'notes'
    ];

    public function absenceReasons(){
        return $this->belongsTo('App\Models\Absences','absence_reason_id','absence_reason_id');
    }
}
