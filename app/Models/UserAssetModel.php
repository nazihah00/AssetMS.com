<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class UserAssetModel extends Model
{
    use HasFactory;
    protected $table = 'user_asset';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'dept',
        'created_at',
        'updated_at',
        'is_delete' 
    ];
    static public function getUserAsset()
    {
        return self::select('id','name') -> where('is_delete', 0) -> get();
    }
}
