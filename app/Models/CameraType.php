<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CameraType extends Model
{
    use HasFactory;
    protected $table = 'camera_types';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'type_name',
        'limit',
        'is_require',
        'sort_order'
    ];
}
