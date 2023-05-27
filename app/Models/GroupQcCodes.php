<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupQcCodes extends Model
{
    use HasFactory;
    protected $table = 'group_code_qcs';
    protected $primaryKey = 'id';
}
