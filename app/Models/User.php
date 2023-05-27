<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserGroup;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'group_id',
        'usercode',
        'username',
        'password',
        'telephone',
        'email',
        'address',
        'region_name',
        'province_id',
        'id_number',
        'description',
        'avatar',
        'bank_number',
        'status',
        'remember_token',
        'created_at'
    ];
    
    public function userGroup(){
        return $this->belongsTo(UserGroup::class, 'group_id', 'group_id');
    }
}
