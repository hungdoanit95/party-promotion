<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reasons extends Model
{
    use HasFactory;
    protected $table = 'reasons';
    protected $primaryKey = 'reason_id';
    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'reason_name',
        'reason_description',
        'reason_deleted',
        'id_deleted'
    ];

    public function groupReasons(){
        return $this->belongsTo('App\Models\ReasonGroups','group_id','group_id');
    }
}
