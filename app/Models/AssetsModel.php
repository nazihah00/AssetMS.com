<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;


class AssetsModel extends Model
{
   use HasFactory;

   protected $table = 'assets';
   protected $primaryKey = 'idasset';
   public $timestamps = true;  
   protected $fillable = [
      'assets_brand_id', 
      'assets_model', 
      'assets_specification',
      'assets_category_assets_id', 
      'assets_company_id', 
      'assets_category_id', 
      'assets_type', 
      'assets_running_num', 
      'assets_serial_num', 
      'assets_location_id', 
      'assets_assigned_user_id', 
      'assets_PO_num', 
      'assets_handover_date', 
      'assets_purchase_cost', 
      'assets_purchase_date', 
      'assets_vendor', 
      'assets_warranty_expiry', 
      'assets_status_id', 
      'assets_supporting_doc'];

    static public function getSingle ($id)

    {
      return self::find($id);
    }

    // public static function getAssets()
    // {
    //     return self::orderBy('idasset', 'asc')->get();
    // }

    public function user()
    {
      return $this->belongsTo(UserAssetModel::class,'assets_assigned_user_id','id');
    }
    public function brand()
    {
      return $this -> belongsTo(BrandsModel::class,'assets_brand_id', 'id');
    }
    public function categoryasset()
    {
      return $this -> belongsTo(CategoryAssetsModel::class,'assets_category_assets_id', 'id');
    }
    public function company()
    {
      return $this->belongsTo(CompanyModel::class,'assets_company_id','idcompany');
    }

    public function category()
    {
      return $this->belongsTo(CategoryModel::class,'assets_category_id','idcategories');
    }

    public function location()
    {
      return $this->belongsTo(LocationModel::class,'assets_location_id','idlocations');
    }

    public function status()
    {
      return $this ->belongsTo(StatusModel::class,'assets_status_id','idstatus');
    }
    public function history()
    {
        return $this->hasMany(StatusHistoryModel::class, 'assets_id', 'idasset')
                    ->where('is_delete', 0)
                    ->orderBy('created_at', 'desc');
        
    }
    public function maintenances()
    {
        return $this->hasMany(MaintenanceModel::class, 'asset_id', 'idasset');
    }
    public function relocations()
    {
        return $this->hasMany(\App\Models\RelocationModel::class, 'asset_id', 'idasset')
                        ->where('is_delete', 0);
    }
    public function disposals()
    {
        return $this->hasMany(DisposalModel::class, 'asset_id', 'idasset')   
                         ->where('is_delete', 0);
    }

}
