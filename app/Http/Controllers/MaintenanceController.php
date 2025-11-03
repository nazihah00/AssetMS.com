<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryAssetsModel;
use App\Models\MaintenanceModel;
use App\Models\VendorModel;
use App\Models\ServiceModel;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class MaintenanceController extends Controller
{ 
    public function list()
    {
        $getRecord = MaintenanceModel::with(['asset'])
                                ->where('is_delete', 0)
                                ->selectRaw('MAX(idmaintenance) as idmaintenance') // ambil latest ID
                                ->groupBy('asset_id')
                                ->pluck('idmaintenance');

    // Ambil semula full record ikut latest ID
    $getRecord = MaintenanceModel::with(['asset'])
        ->whereIn('idmaintenance', $getRecord)
        ->orderByDesc('date')
        ->paginate(10);

    return view('maintenance.list', compact('getRecord'));

    }
    
    
    public function add():View
    {
        $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
        $getVendor = VendorModel::getVendor();
        $getService = ServiceModel::getService();
        return view ('maintenance.add', compact('getCategoryAsset', 'getVendor', 'getService'));
    }


    public function insert(Request $request)
    {
        $request->validate([
            'category_assets_id' => 'required',
            'asset_id' => 'required',
            'date' => 'required|date',
            'service_type_id' => 'required',
            'time' => 'required',
            'problem_desc' => 'nullable|string',
            'resolution' => 'nullable|string',
            'vendor_id' => 'required',
            'cost' => 'required|numeric',
        ]);

        $maintenance = new MaintenanceModel();
        $maintenance->category_assets_id = $request->category_assets_id;
        $maintenance->asset_id = $request->asset_id;
        $maintenance->date = $request->date;
        $maintenance->service_type_id = $request->service_type_id;
        $maintenance->time = $request->time;
        $maintenance->problem_desc = $request->problem_desc;
        $maintenance->resolution = $request->resolution;
        $maintenance->vendor_id = $request->vendor_id;
        $maintenance->cost = $request->cost;
        $maintenance->is_delete = 0;
        $maintenance->save();

        return redirect('/maintenance/list')->with('success', 'Maintenance record added successfully');
    }

    public function edit($id):View
    {
        $getRecord = MaintenanceModel::getSingle(base64_decode($id));

        if ($getRecord ){
         $getCategoryAsset = CategoryAssetsModel::getCategoryAsset();
         $getVendor = VendorModel::getVendor();
         $getService = ServiceModel::getService();
         return view('maintenance.edit', compact('getRecord','getCategoryAsset','getVendor','getService'));
        }
        else{
            abort (code:404);
        }
        
    }
    public function update(Request $request, $id):RedirectResponse
    {
        $request->validate([
            'category_assets_id' => 'required',
            'asset_id' => 'required',
            'date' => 'required|date',
            'service_type_id' => 'required',
            'time' => 'required',
            'problem_desc' => 'nullable|string',
            'resolution' => 'nullable|string',
            'vendor_id' => 'required',
            'cost' => 'required|numeric',
        ]);
        $old = MaintenanceModel::findOrFail($id);

        $newRecord = MaintenanceModel::create([
            'category_assets_id'  => $old->category_assets_id, 
            'asset_id'            => $old->asset_id,                
            'date'                => $request->date,
            'service_type_id'     => $request->service_type_id,
            'time'                => $request->time,
            'vendor_id'           => $request->vendor_id,
            'cost'                => $request->cost,
            'problem_desc'        => $request->problem_desc,
            'resolution'          => $request->resolution,
        ]);
    

        return redirect('/maintenance/view/'.base64_encode($newRecord->asset_id))
           ->with('success', 'Maintenance saved and history recorded.');
    }

    public function view($id)
    {
        $assetId = base64_decode($id);

        $getRecord = \App\Models\AssetsModel::with([
            'brand',
            'categoryAsset',
            'maintenances.vendor',
            'maintenances.service'
        ])
        ->findOrFail($assetId);

    return view('maintenance.view', compact('getRecord'));
    }


    public function delete($id):RedirectResponse
    {
        $maintenance = MaintenanceModel::findOrFail($id);
        $maintenance->is_delete = 1;
        $maintenance->save();
        return redirect('/maintenance/list')->with('success', 'Maintenance record deleted successfully');
    }


 }
