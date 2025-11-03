<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssetsModel;
use App\Models\User;
use App\Models\UserAssetModel;
use App\Models\CompanyModel;
use App\Models\CategoryModel;
use App\Models\LocationModel;
use App\Models\StatusModel;
use App\Models\BrandsModel;
use App\Models\CategoryAssetsModel;
use App\Models\StatusHistoryModel;
use App\Models\VendorModel;
use App\Models\DisposalModel;
use App\Models\MaintenanceModel;
use App\Models\RelocationModel;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AssetsController extends Controller
{
    public function list(Request $request)
    {
        $query = AssetsModel::with(['brand','category','company','categoryasset','location','status','user'])
                            ->where('is_delete', 0);

        if (!empty($request->search)) {
            $search = $request->search;
    
            $query->where(function ($q) use ($search) {
                // Search column dalam assets table
                $q->where('assets_model', 'like', "%$search%")
                  ->orWhere('assets_specification', 'like', "%$search%")
                  ->orWhere('assets_serial_num', 'like', "%$search%")
                  ->orWhere('assets_running_num', 'like', "%$search%")
                  ->orWhere('assets_type', 'like', "%$search%")
                  ->orWhere('assets_PO_num', 'like', "%$search%");
    
                // Search dalam relationship
                $q->orWhereHas('category', function($q2) use ($search) {
                    $q2->where('categories_code', 'like', "%$search%");
                });
    
                $q->orWhereHas('categoryasset', function($q2) use ($search) {
                    $q2->where('category_type', 'like', "%$search%");
                });
    
                $q->orWhereHas('brand', function($q2) use ($search) {
                    $q2->where('brands_name', 'like', "%$search%");
                });
    
                $q->orWhereHas('company', function($q2) use ($search) {
                    $q2->where('company_name', 'like', "%$search%");
                });
    
                $q->orWhereHas('location', function($q2) use ($search) {
                    $q2->where('locations_name', 'like', "%$search%");
                });
    
                $q->orWhereHas('status', function($q2) use ($search) {
                    $q2->where('status_type', 'like', "%$search%");
                });
    
                $q->orWhereHas('user', function($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%")
                       ->orWhere('staff_num', 'like', "%$search%");
                });
            });
        }
        
        $getRecord = $query->paginate(10);
        $assetIds = $getRecord->pluck('idasset')->toArray();
        $getHistory = StatusHistoryModel::with(['status', 'assignedUser', 'changedByUser'])
        ->where('assets_id',  $assetIds)
        ->where('is_delete', 0)
        ->orderBy('created_at', 'desc')
        ->get();
    
        return view('assets.list', compact('getRecord','getHistory'));
    }

    public function add(): View
    {
        $getUserAsset = UserAssetModel::getUserAsset();
        $getBrand = BrandsModel::getBrand();
        $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
        $getCompany = CompanyModel::getCompany();
        $getCategory = CategoryModel::getCategory();
        $getLocation = LocationModel::getLocation();
        $getStatus = StatusModel::getStatus();
        $getVendor = VendorModel::getVendor();

        return view('assets.add', compact('getUserAsset', 'getBrand', 'getCategoryAsset', 'getCompany', 'getCategory', 'getLocation', 'getStatus','getVendor'));
    }
    

    public function insert(Request $request): RedirectResponse
    {
        $request->validate([
            'assets_brand_id' => 'required',
            'assets_model' => 'required',
            'assets_specification' => 'required',
            'assets_category_assets_id' => 'required',
            'assets_company_id' => 'required',
            'assets_category_id' => 'required',
            'assets_type' => 'required',
            'assets_running_num' => 'required',
            'assets_serial_num' => 'required',
            'assets_location_id' => 'required',
            'assets_assigned_user_id' => 'required',
            'assets_PO_num' => 'required',
            'assets_handover_date' => 'required',
            'assets_purchase_cost' => 'required',
            'assets_purchase_date' => 'required',
            'assets_vendor_id' => 'required',
            'assets_warranty_expiry' => 'required',
            'assets_status_id' => 'required',
            'assets_supporting_doc' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,png,jpg,jpeg|max:25600',
        ]);



        $assets = new AssetsModel();
        $assets->assets_brand_id = $request->assets_brand_id;
        $assets->assets_model = $request->assets_model;
        $assets->assets_specification = $request->assets_specification;
        $assets->assets_category_assets_id = $request->assets_category_assets_id;
        $assets->assets_company_id = $request->assets_company_id;
        $assets->assets_category_id = $request->assets_category_id;
        $assets->assets_type = $request->assets_type;
        $assets->assets_running_num = $request->assets_running_num;
        $assets->assets_serial_num = $request->assets_serial_num;
        $assets->assets_location_id = $request->assets_location_id;
        $assets->assets_assigned_user_id = $request->assets_assigned_user_id;
        $assets->assets_PO_num = $request->assets_PO_num;
        $assets->assets_handover_date = $request->assets_handover_date;
        $assets->assets_purchase_cost = $request->assets_purchase_cost;
        $assets->assets_purchase_date = $request->assets_purchase_date;
        $assets->assets_vendor_id = $request->assets_vendor_id;
        $assets->assets_warranty_expiry = $request->assets_warranty_expiry;
        $assets->assets_status_id = $request->assets_status_id;
         // Handle file upload (supporting doc)
         if ($request->hasFile('assets_supporting_doc') && $request->file('assets_supporting_doc')->isValid()) {
            $file = $request->file('assets_supporting_doc');    
            $ext = $file->getClientOriginalExtension();
            $filename = strtolower(Str::random(20)) . '.' . $ext;
            $file->move('upload/assets_docs/', $filename);
            $assets->assets_supporting_doc = $filename;
        }        
        $assets->save();
        return redirect('/assets/add')->with('success', 'Assets added successfully');
    } 

    public function edit($id): View
    {
        $getRecord = AssetsModel::getSingle(base64_decode($id));

       if ($getRecord){
            $getUserAsset = UserAssetModel::getUserAsset();
            $getBrand = BrandsModel::getBrand();
            $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
            $getCompany = CompanyModel::getCompany();
            $getCategory = CategoryModel::getCategory();
            $getLocation = LocationModel::getLocation();
            $getStatus = StatusModel::getStatus();
            $getVendor = VendorModel::getVendor();
            return view ('assets.edit',compact('getRecord','getBrand', 'getCategoryAsset', 'getUserAsset','getCompany','getCategory','getLocation','getStatus','getVendor'));
       }
       else {
        abort(code:404);
       }

    }

    public function update(Request $request, $id): RedirectResponse
    {
            $request->validate([
                'assets_brand_id' => 'required',
                'assets_model' =>'required',
                'assets_specification' => 'required',
                'assets_category_assets_id' => 'required',
                'assets_company_id' => 'required',
                'assets_category_id' => 'required',
                'assets_type' => 'required',
                'assets_running_num' => 'required',
                'assets_serial_num' => 'required',
                'assets_location_id' => 'required',
                'assets_assigned_user_id' => 'required',
                'assets_PO_num' => 'required',
                'assets_handover_date' => 'required',
                'assets_purchase_cost' => 'required',
                'assets_purchase_date' => 'required',
                'assets_vendor_id' => 'required',
                'assets_warranty_expiry' => 'required',
                'assets_status_id' => 'required',
                'assets_supporting_doc' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:25600',
            ]);

            $assets = AssetsModel::findOrFail($id);
            $assets->assets_brand_id = $request->assets_brand_id;
            $assets->assets_model = $request->assets_model;
            $assets->assets_specification = $request->assets_specification;
            $assets->assets_category_assets_id = $request->assets_category_assets_id;
            $assets->assets_company_id = $request->assets_company_id;
            $assets->assets_category_id = $request->assets_category_id;
            $assets->assets_type = $request->assets_type;
            $assets->assets_running_num = $request->assets_running_num;
            $assets->assets_serial_num = $request->assets_serial_num;
            $assets->assets_location_id = $request->assets_location_id;
            $assets->assets_assigned_user_id = $request->assets_assigned_user_id;
            $assets->assets_PO_num = $request->assets_PO_num;
            $assets->assets_handover_date = $request->assets_handover_date;
            $assets->assets_purchase_cost = $request->assets_purchase_cost;
            $assets->assets_purchase_date = $request->assets_purchase_date;
            $assets->assets_vendor_id = $request->assets_vendor_id;
            $assets->assets_warranty_expiry = $request->assets_warranty_expiry;
            $assets->assets_status_id = $request->assets_status_id;
        
            // Handle file upload (optional)
            if ($request->hasFile('assets_supporting_doc') && $request->file('assets_supporting_doc')->isValid()) {
                $file = $request->file('assets_supporting_doc');
                $ext = $file->getClientOriginalExtension();
                $filename = strtolower(Str::random(20)) . '.' . $ext;
                $file->move('upload/assets_docs/', $filename);
                $assets->assets_supporting_doc = $filename;
            }
        
            $assets->save();

            StatusHistoryModel::create([
                'assets_id'         => $assets->idasset,
                'status_id'         => $request->assets_status_id,
                'assigned_to_id'    => $request->assets_assigned_user_id,
                'remarks'           => $request->remarks ?? null,
                'created_at'        => now(),
                'changed_by'        => Auth::check() ? Auth::id() : 0, 
                'is_delete'         => 0,
            ]);
        
            return redirect('/assets/list')->with('success', 'Assets updated successfully');
        
    }
    public function view($id)
    {
        $getRecord = AssetsModel::getSingle(base64_decode($id));

        if ($getRecord) {
            $getUserAsset = UserAssetModel::getUserAsset();
            $getBrand = BrandsModel::getBrand();
            $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
            $getCompany  = CompanyModel::getCompany();
            $getCategory = CategoryModel::getCategory();
            $getLocation = LocationModel::getLocation();
            $getStatus   = StatusModel::getStatus();
            $getVendor = VendorModel::getVendor();

            return view('assets.view', compact(
                'getRecord', 'getBrand','getCategoryAsset', 'getUserAsset',
                'getCompany', 'getCategory', 'getLocation', 'getStatus', 'getVendor'
            ));
        } else {
            abort(404);
        }
    }

    public function history($id)
    {
        $assetId = base64_decode($id);

        // Dapatkan maklumat asas asset
        $getRecord = AssetsModel::with(['brand', 'category', 'company', 'location', 'status', 'user'])
            ->findOrFail($assetId);

        // 1️⃣ Status History
        $getHistory = \App\Models\StatusHistoryModel::with(['status', 'assignedUser', 'changedByUser'])
            ->where('assets_id', $assetId)
            ->where('is_delete', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        // 2️⃣ Maintenance History
        $getMaintenance = \App\Models\MaintenanceModel::with('asset')
            ->where('asset_id', $assetId)
            ->where('is_delete', 0)
            ->orderBy('date', 'desc')
            ->get();

        // 3️⃣ Relocation History
        $getRelocation = \App\Models\RelocationModel::with(['asset', 'newUser', 'newLocation'])
            ->where('asset_id', $assetId)
            ->where('is_delete', 0)
            ->orderBy('relocation_date', 'desc')
            ->get();

        // 4️⃣ Disposal History
        $getDisposal = \App\Models\DisposalModel::with('asset')
            ->where('asset_id', $assetId)
            ->where('is_delete', 0)
            ->orderBy('disposal_date', 'desc')
            ->get();

        return view('assets.history', compact(
            'getRecord',
            'getHistory',
            'getMaintenance',
            'getRelocation',
            'getDisposal'
        ));
    }


    public function updateHistory(Request $request, $id)
    {
        // validate input
        $request->validate([
            'remarks' => 'nullable|string',
        ]);

        $history = StatusHistoryModel::findOrFail($id);
        $history->remarks = $request->remarks;
        $history->save();

        return redirect()->back()->with('success', 'History updated successfully.');
    }


    public function delete($id):RedirectResponse
    {
        $assets = AssetsModel::findOrFail($id);
        $assets->is_delete = 1; 
        $assets ->save();
        
        return redirect() -> route('assets.list') ->with('success','Assets deleted sucessfully');
    }
    
    public function getAssetsByCategory($id)
    {
        $assets = AssetsModel::with('brand','location','user') // eager load brand
                    ->where('assets_category_assets_id', $id)
                    ->get();

        return response()->json($assets);
    }

}

