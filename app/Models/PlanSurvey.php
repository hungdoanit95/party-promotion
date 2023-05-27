<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanSurvey extends Model
{
    use HasFactory;
    protected $table = 'plan_surveys';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'plan_id',
        'user_id',
        'data_json',
        'result',
        'created_at',
        'updated_at'
    ];
}
