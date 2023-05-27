<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    use HasFactory;

    protected $table = 'survey_questions';
    protected $primaryKey = 'survey_id';
    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'survey_name',
        'target',
        'survey_type',
        'survey_sort'
    ];

    public function groupQuestion(){
        return $this->belongsTo('App\Models\SurveyGroup','group_id','group_id');
    }
}
