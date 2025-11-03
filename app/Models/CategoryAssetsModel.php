<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class CategoryAssetsModel extends Model
{
    use HasFactory;
    protected $table = 'category_assets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_type',
        'created_at',
        'updated_at',
        'is_delete'
        
    ];

    static public function getCategoryAsset()
    {
        return self::select('id','category_type') -> where('is_delete', 0) -> get();
    }
    public function getAssets()
    {
        return $this->hasMany(AssetsModel::class, 'assets_category_assets_id', 'id');
    }

}
