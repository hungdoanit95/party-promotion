<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanParty extends Model
{
    use HasFactory;
    protected $table = 'plan_party';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'party_id',
        'user_id',
        'latitude',
        'longitude',
        'check_image',
        'check_barcode',
        'check_input',
        'check_reason',
        'check_share',
        'reason_name',
        'time_checkin',
        'status'
    ];
}
