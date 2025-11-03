<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class ServiceModel extends Model
{
    use HasFactory;
    protected $table = 'service_type';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type',
        'created_at',
        'updated_at',
        'is_delete' 
    ];
    static public function getService()
    {
        return self::select('id','type') -> where('is_delete', 0) -> get();
    }
}