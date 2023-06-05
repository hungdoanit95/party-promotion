<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPartySurvey extends Model
{
    use HasFactory;
    protected $table = 'plan_party_survey';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'plan_party_id',
        'user_id',
        'data_json',
        'result'
    ];
}
