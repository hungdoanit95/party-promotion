<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarcodePlan extends Model
{
    use HasFactory;
    protected $table = 'barcode_plan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'barcode_presenter',
        'barcode_owner',
        'plan_id',
        'level'
    ];
    public $timestamps = true;
}
