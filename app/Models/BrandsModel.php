<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class BrandsModel extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'id';
    protected $fillable = [
        'brands_name',
        'created_at',
        'updated_at',
        'is_delete'
        
    ];
    
    static public function getBrand()
    {
        return self::select('id','brands_name') -> where('is_delete', 0) -> get();
    }
}
