<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanQcCode extends Model
{
    use HasFactory;
    protected $table = 'plan_qc_code';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'qc_code',
        'plan_id',
        'user_tick_code',
        'created_at',
        'updated_at',
        'sort_order'
    ];
}
