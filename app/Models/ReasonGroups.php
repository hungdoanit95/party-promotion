<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonGroups extends Model
{
    use HasFactory;
    protected $table = 'reason_groups';
    protected $primaryKey = 'group_id';
    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'group_name',
        'parent_id',
        'status'
    ];
    public function reasonLists() {
        return $this->hasMany('App\Models\Reasons','group_id','group_id');
    }
}
