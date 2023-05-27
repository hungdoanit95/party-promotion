<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanNote extends Model
{
    use HasFactory;
    
    protected $table = 'plan_note';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'user_id',
        'note_type',
        'note_content',
        'plan_id'
    ];
}
