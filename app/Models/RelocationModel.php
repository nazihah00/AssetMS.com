<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;


class RelocationModel extends Model
{
    use HasFactory;
    protected $table = 'relocation';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_assets_id',
        'asset_id',
        'new_user_id',
        'new_location_id',
        'reason',
        'relocation_date',
        'attachment',
        'created_at',
        'updated_at',
        'is_delete'
        
    ];
    public function categoryasset()
    {
        return $this->belongsTo(CategoryAssetsModel::class, 'category_assets_id', 'id');
    }
    public function asset()
    {
        return $this->belongsTo(AssetsModel::class, 'asset_id', 'idasset');
    }
    public static function getRelocation()
    {
        return self::where('is_delete', 0)->get();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function newUser()
    {
        return $this->belongsTo(\App\Models\UserAssetModel::class, 'new_user_id', 'id');
    }
    public function newLocation()
    {
        return $this->belongsTo(\App\Models\LocationModel::class, 'new_location_id', 'idlocations');
    }

}
