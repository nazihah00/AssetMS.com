<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class MaintenanceModel extends Model
{
    use HasFactory;
    protected $table = 'maintenance';
    protected $primaryKey = 'idmaintenance';
    protected $fillable = [
        'category_assets_id',
        'asset_id',
        'date',
        'service_type_id',
        'time',
        'problem_desc',
        'resolution',
        'vendor_id',
        'cost',
        'created_by',
        'updated_at',
        'is_delete'
        
    ];

    public function asset()
    {
        return $this->belongsTo(AssetsModel::class, 'asset_id', 'idasset');
    }
    public function categoryasset()
    {
        return $this->belongsTo(CategoryAssetsModel::class, 'category_assets_id', 'id');
    }
    public function vendor()
    {
        return $this->belongsTo(VendorModel::class, 'vendor_id', 'idvendors');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function getMaintenance()
    {
        return self::where('is_delete', 0)->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function service()
    {
        return $this->belongsTo(ServiceModel::class, 'service_type_id', 'id');
    }
    
}
