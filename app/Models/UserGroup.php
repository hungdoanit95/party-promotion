<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserGroup extends Model
{
    use HasFactory;

    protected $table = 'user_groups';
    protected $primaryKey = 'group_id';
    public $timestamps = true;

    protected $fillable = [
        'group_id',
        'group_name',
        'group_code',
        'parent_id',
        'status'
    ];
    
    public function listUsers(){
        return $this->hasMany(User::class, 'group_id', 'group_id');
    }
}
