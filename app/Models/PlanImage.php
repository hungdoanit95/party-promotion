<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanImage extends Model
{
    use HasFactory;
    
    protected $table = 'plan_images';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'plan_id',
        'user_id',
        'link_image',
        'type_image',
        'created_at',
        'updated_at'
    ];
}
