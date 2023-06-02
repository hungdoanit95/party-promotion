<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parties extends Model
{
    use HasFactory;
    protected $table = 'parties';
    protected $primaryKey = 'id';
    protected $fillable = array(
        'id',
        'party_code',
        'introducer_name',
        'avatar',
        'introducer_phone',
        'party_host_name',
        'party_host_phone',
        'party_type',
        'party_level',
        'beer_type',
        'organization_date',
        'organization_time',
        'province',
        'district',
        'ward',
        'street',
        'home_number',
        'notes',
        'distributor',
        'point_of_salename',
        'point_of_salephone',
        'status'
    );
}
