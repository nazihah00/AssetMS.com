<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Model
{
    use HasFactory;
    protected $table = 'user_role';
    protected $fillable = [
        'id',
        'gp_name',
        'is_delete'
        
    ];

    static public function getUserRole()
    {
        return self:: select('id','gp_name')->get();
    }
}
