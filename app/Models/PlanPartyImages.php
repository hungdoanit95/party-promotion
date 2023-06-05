<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanPartyImages extends Model
{
    use HasFactory;
    protected $table = 'plan_party_images';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'plan_party_id',
        'user_id',
        'link_image',
        'type_image',
        'camera_id',
        'is_deleted',
    ];
}
