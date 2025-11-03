<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'idcategories';
    protected $fillable = [
        'categories_code',
        'categories_desc',
        'created_at',
        'updated_at',
        'is_delete'
        
    ];

    static public function getCategory()
    {
        return self:: select('idcategories','categories_code')->where('is_delete', 0) -> get();
    }
}
