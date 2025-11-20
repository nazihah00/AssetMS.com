<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';

    protected $fillable = [
        'name',
        'staff_num',
        'department', 
        'phone_num',
        'user_role_id',
        'branch',
        'email',
        'password',
        'is_delete',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function getSingle($id)
    {
        return self::findOrFail($id);
    }
        
    public static function getUser()
    {
        $query = self::query();
        
        // Check if is_delete column exists before using it
        if (Schema::hasColumn('users', 'is_delete')) {
            $query->where('is_delete', 0);
        }
        
        return $query->orderBy('id', 'desc')
                ->paginate(10); // 10 rekod per page
    }

    public function role()
    {
        return $this->belongsTo(UserRoleModel::class, 'user_role_id','id');
    }
}
