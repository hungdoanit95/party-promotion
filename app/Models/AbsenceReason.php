<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsenceReason extends Model
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
}
