<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyModel;
use App\Models\BrandsModel;
use App\Models\CategoryAssetsModel;
use App\Models\LocationModel;
use App\Models\StatusModel;
use App\Models\CategoryModel; 
use App\Models\VendorModel;
use App\Models\UserAssetModel;
use App\Models\ServiceModel;

class AssetSettingController extends Controller
{
    public function indexCompany()
    {
        $getCompany = CompanyModel::where('is_delete', 0)
                                    ->orderBy('company_name','asc')
                                    ->paginate(10); // ambil semua data company
        $getBrand = BrandsModel::where('is_delete', 0)
                                    ->orderBy('brands_name','asc')
                                    ->paginate(10); // ambil semua data brand
        $getCategoryAsset = CategoryAssetsModel::where('is_delete', 0)
                                    ->orderBy('category_type','asc')
                                    ->paginate(10); // ambil semua data category asset
        $getCategory = CategoryModel::where('is_delete', 0)
                                    ->orderBy('categories_code','asc')
                                    ->paginate(10); // ambil semua data category
        $getLocation = LocationModel::where('is_delete', 0)
                                    ->orderBy('locations_name','asc')
                                    ->paginate(10); // ambil semua data location
        $getStatus = StatusModel::where('is_delete', 0)
                                    ->orderBy('status_type','asc')
                                    ->paginate(10); // ambil semua data status
        $getVendor = VendorModel::where('is_delete', 0)
                                    ->orderBy('vendors_name','asc')
                                    ->paginate(10); // ambil semua data vendor  
        $getUserAsset = UserAssetModel::where('is_delete', 0)
                                    ->orderBy('name','asc')
                                    ->paginate(10);    
        $getService = ServiceModel::where('is_delete', 0)
                                    ->orderBy('type','asc')
                                    ->paginate(10);    
        return view('assets.assetssetting', compact('getCompany', 'getBrand', 'getCategoryAsset', 'getCategory', 'getLocation','getStatus','getVendor','getUserAsset','getService'));
    }

    public function storeCompany (Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255'
        ]);

        $company = new CompanyModel();
        $company -> company_name = $request->company_name;
        $company->save();
        
        return redirect()->route('assetssetting.indexCompany')->with('success','Company added succesfully!');
    }

    public function updateCompany(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string|max:255'
        ]);
        $company = CompanyModel::findorFail($id);
        $company->company_name = $request->company_name;
        $company->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Company updated succesfully!');
    }

    public function deleteCompany($id)
    {
        $company = CompanyModel::findorFail($id);
        $company->is_delete = 1;
        $company->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Company deleted succesfully!');
    }

    public function storeBrand(Request $request)
    {
        $request->validate([
            'brands_name' => 'required|string|max:255'
        ]);
        $brand = new BrandsModel();
        $brand->brands_name = $request->brands_name;
        $brand->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Brand added succesfully!');
    }

    public function updateBrand(Request $request, $id)
    {
        $request->validate([
            'brands_name' => 'required|string|max:255'
        ]);
        $brand = BrandsModel::findorFail($id);
        $brand->brands_name = $request->brands_name;
        $brand->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Brand updated succesfully!');
    }

    public function deleteBrand($id)
    {
        $brand = BrandsModel::findorFail($id);
        $brand->is_delete = 1;
        $brand->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Brand deleted succesfully!');
    }
    public function storeCategoryAssets(Request $request)
    {
        $request->validate([
            'category_type' => 'required|string|max:255'
        ]);
        $categoryAsset = new CategoryAssetsModel();
        $categoryAsset->category_type = $request->category_type;
        $categoryAsset->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Category Assets added succesfully!');
    }
    public function updateCategoryAssets(Request $request, $id)
    {
        $categoryAsset = CategoryAssetsModel::findorFail($id);
    
        $request->validate([
            'category_type' => 'required|string|max:255'
        ]);
    
        $categoryAsset->category_type = $request->category_type;
        $categoryAsset->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Category Assets updated succesfully!');
    }
    public function deleteCategoryAssets($id)
    {
        $categoryAsset = CategoryAssetsModel::findorFail($id);
        $categoryAsset->is_delete = 1;
        $categoryAsset->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Category Assets deleted succesfully!');
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'categories_code' => 'required|string|max:255',
            'categories_desc' => 'required|string|max:255'
        ]);
        $category = new CategoryModel();
        $category->categories_code = $request->categories_code;
        $category->categories_desc = $request->categories_desc;
        $category->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Category added succesfully!');
    }
    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'categories_code' => 'required|string|max:255',
            'categories_desc' => 'required|string|max:255'
        ]);
        $category = CategoryModel::findorFail($id);
        $category->categories_code = $request->categories_code;
        $category->categories_desc = $request->categories_desc;
        $category->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Category updated succesfully!');
    }
    public function deleteCategory($id)
    {
        $category = CategoryModel::findorFail($id);
        $category->is_delete = 1;
        $category->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Category deleted succesfully!');
    }
    public function storeLocation(Request $request)
    {
        $request->validate([
            'locations_name' => 'required|string|max:255'
        ]);
        $location = new LocationModel();
        $location->locations_name = $request->locations_name;
        $location->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Location added succesfully!');
    }
    public function updateLocation(Request $request, $id)
    {
        $request->validate([
            'locations_name' => 'required|string|max:255'
        ]);
        $location = LocationModel::findorFail($id);
        $location->locations_name = $request->locations_name;
        $location->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Location updated succesfully!');
    }
    public function deleteLocation($id)
    {
        $location = LocationModel::findorFail($id);
        $location->is_delete = 1;
        $location->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Location deleted succesfully!');
    }
    public function storeStatus(Request $request)
    {
        $request->validate([
            'status_type' => 'required|string|max:255'
        ]);
        $status = new StatusModel();
        $status->status_type = $request->status_type;
        $status->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Status added succesfully!');
    }
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_type' => 'required|string|max:255'
        ]);
        $status = StatusModel::findorFail($id);
        $status->status_type = $request->status_type;
        $status->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Status updated succesfully!');
    }
    public function deleteStatus($id)
    {
        $status = StatusModel::findorFail($id);
        $status->is_delete = 1;
        $status->save();
        return redirect()->route('assetssetting.indexCompany')->with('success','Status deleted succesfully!');
    }
    public function storeVendor(Request $request)
    {
        $request->validate([
            'vendors_name' => 'required|string|max:255'
        ]);
        $vendor = new VendorModel();
        $vendor->vendors_name = $request->vendors_name;
        $vendor->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Vendor added succesfully!');
    }
    public function updateVendor(Request $request, $id)
    {
        $request->validate([
            'vendors_name' => 'required|string|max:255'
        ]);
        $vendor = VendorModel::findorFail($id);
        $vendor->vendors_name = $request->vendors_name; 
        $vendor->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Vendor updated succesfully!');
    }
    public function deleteVendor($id)
    {
        $vendor = VendorModel::findorFail($id);
        $vendor->is_delete = 1;
        $vendor->save();
        return redirect()->route('assetssetting.indexCompany')->with('success','Vendor deleted succesfully!');
    }
    public function storeUserAsset(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dept' => 'required|string|max:255'
        ]);
        $userAsset = new UserAssetModel();
        $userAsset->name = $request->name;
        $userAsset->dept = $request->dept;
        $userAsset->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','User added succesfully!');
    }
    public function updateUserAsset(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dept' => 'required|string|max:255'
        ]);
        $userAsset = UserAssetModel::findorFail($id);
        $userAsset->name = $request->name; 
        $userAsset->dept = $request->dept;
        $userAsset->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','User updated succesfully!');
    }
    public function deleteUserAsset($id)
    {
        $userAsset = UserAssetModel::findorFail($id);
        $userAsset->is_delete = 1;
        $userAsset->save();
        return redirect()->route('assetssetting.indexCompany')->with('success','User deleted succesfully!');
    }
    public function storeService(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255'
        ]);
        $service = new ServiceModel();
        $service->type = $request->type;
        $service->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Service added succesfully!');
    }
    public function updateService(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255'
        ]);
        $service = ServiceModel::findorFail($id);
        $service->type = $request->type; 
        $service->save();

        return redirect()->route('assetssetting.indexCompany')->with('success','Service updated succesfully!');
    }
    public function deleteService($id)
    {
        $service = ServiceModel::findorFail($id);
        $service->is_delete = 1;
        $service->save();
        return redirect()->route('assetssetting.indexCompany')->with('success','Service deleted succesfully!');
    }
}
    
