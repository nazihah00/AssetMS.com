<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class DisposalModel extends Model
{
    use HasFactory;
    protected $table = 'disposal';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_assets_id',
        'asset_id',
        'disposal_date',
        'disposal_reason',
        'disposal_method',
        'support_doc',
        'created_by',
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
    public static function getDisposal()
    {
        return self::where('is_delete', 0)->get();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function disposalHistory()
    {
        return $this->hasMany(DisposalModel::class, 'asset_id', 'asset_id')
                    ->where('is_delete', 0)
                    ->orderBy('disposal_date', 'desc');
    }


}
