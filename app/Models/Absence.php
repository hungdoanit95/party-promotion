<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    use HasFactory;
    protected $table = 'absences';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'date_off',
        'user_id',
        'reason_off_id',
        'notes',
        'created_at',
        'updated_at'
    ];
}
