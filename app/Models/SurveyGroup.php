<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyGroup extends Model
{
    use HasFactory;
    protected $table = 'survey_groups';
    protected $primaryKey = 'group_id';
    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'group_name',
        'parent_id',
        'reason_deleted',
        'id_deleted'
    ];

    public function questionLists() {
        return $this->hasMany('App\Models\SurveyQuestion','group_id','group_id');
    }
}
