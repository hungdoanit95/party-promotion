<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyHistory extends Model
{
    use HasFactory;
    
    protected $table = 'survey_history';
    
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'route_plan',
        'group_id',
        'parent_id',
        'questions',
        'created_at',
        'updated_at'
    ];
}
