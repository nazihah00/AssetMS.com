<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AssetSettingController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\DisposalController;
use App\Http\Controllers\RelocationController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {

Route::get('/dashboard', function () {
        return response()
        ->view('dashboard')
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
})->name('login');

Route::get('/auth/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/auth/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/auth/userlist', [UserController::class, 'list'])-> name ('auth.userlist');
Route::get('/auth/edituser/{id}', [UserController::class, 'edit'])->name('auth.edituser');
Route::post('/auth/edituser/{id}', [UserController::class, 'update'])->name('auth.edituser');
Route::post('/auth/delete/{id}', [UserController::class, 'delete'])->name('auth.delete');

Route::get ('/assets/list', [AssetsController::class,'list'])->name('assets.list');
Route::get('/assets/add', [AssetsController::class, 'add'])->name('assets.add');
Route::post('/assets/add', [AssetsController::class, 'insert'])->name('assets.add');
Route::get('/assets/edit/{id}', [AssetsController::class, 'edit'])->name('assets.edit');
Route::post('/assets/edit/{id}', [AssetsController::class, 'update'])->name('assets.edit');
Route::post('/assets/delete/{id}', [AssetsController::class, 'delete'])->name('assets.delete');
Route::get('/assets/view/{id}', [AssetsController::class, 'view'])->name('assets.view');

Route::post('/status/history/{id}/update', [AssetsController::class, 'updateHistory'])->name('assets.updateHistory');

//company
Route::get('/assets/assetssetting', [AssetSettingController::class, 'indexCompany'])->name('assetssetting.indexCompany');
Route::post('/assets/assetssetting/company', [AssetSettingController::class, 'storeCompany'])->name('assetssetting.storeCompany');
Route::put('/assets/assetssetting/company/{id}', [AssetSettingController::class, 'updateCompany'])->name('assetssetting.updateCompany');
Route::delete('/assets/assetssetting/company/{id}', [AssetSettingController::class, 'deleteCompany'])->name('assetssetting.deleteCompany');

//brand
Route::post('/assets/assetssetting/brand', [AssetSettingController::class, 'storeBrand'])->name('assetssetting.storeBrand');
Route::put('/assets/assetssetting/brand/{id}', [AssetSettingController::class, 'updateBrand'])->name('assetssetting.updateBrand');
Route::delete('/assets/assetssetting/brand/{id}', [AssetSettingController::class, 'deleteBrand'])->name('assetssetting.deleteBrand');

//category assets
Route::post('/assets/assetssetting/categoryassets', [AssetSettingController::class, 'storeCategoryAssets'])->name('assetssetting.storeCategoryAssets');
Route::put('/assets/assetssetting/categoryassets/{id}', [AssetSettingController::class, 'updateCategoryAssets'])->name('assetssetting.updateCategoryAssets');
Route::delete('/assets/assetssetting/categoryassets/{id}', [AssetSettingController::class, 'deleteCategoryAssets'])->name('assetssetting.deleteCategoryAssets');

//category
Route::post('/assets/assetssetting/category', [AssetSettingController::class, 'storeCategory'])->name('assetssetting.storeCategory');
Route::put('/assets/assetssetting/category/{id}', [AssetSettingController::class, 'updateCategory'])->name('assetssetting.updateCategory');
Route::delete('/assets/assetssetting/category/{id}', [AssetSettingController::class, 'deleteCategory'])->name('assetssetting.deleteCategory');

//location
Route::post('/assets/assetssetting/location', [AssetSettingController::class, 'storeLocation'])->name('assetssetting.storeLocation');
Route::put('/assets/assetssetting/location/{id}', [AssetSettingController::class, 'updateLocation'])->name('assetssetting.updateLocation');
Route::delete('/assets/assetssetting/location/{id}', [AssetSettingController::class, 'deleteLocation'])->name('assetssetting.deleteLocation');

//status
Route::post('/assets/assetssetting/status', [AssetSettingController::class, 'storeStatus'])->name('assetssetting.storeStatus');
Route::put('/assets/assetssetting/status/{id}', [AssetSettingController::class, 'updateStatus'])->name('assetssetting.updateStatus');
Route::delete('/assets/assetssetting/status/{id}', [AssetSettingController::class, 'deleteStatus'])->name('assetssetting.deleteStatus');

//service
Route::post('/assets/assetssetting/service', [AssetSettingController::class, 'storeService'])->name('assetssetting.storeService');
Route::put('/assets/assetssetting/service/{id}', [AssetSettingController::class, 'updateService'])->name('assetssetting.updateService');
Route::delete('/assets/assetssetting/service/{id}', [AssetSettingController::class, 'deleteService'])->name('assetssetting.deleteService');

//vendor
Route::post('/assets/assetssetting/vendor', [AssetSettingController::class, 'storeVendor'])->name('assetssetting.storeVendor');
Route::put('/assets/assetssetting/vendor/{id}', [AssetSettingController::class, 'updateVendor'])->name('assetssetting.updateVendor');
Route::delete('/assets/assetssetting/vendor/{id}', [AssetSettingController::class, 'deleteVendor'])->name('assetssetting.deleteVendor');

//UserAsset
Route::post('/assets/assetssetting/userasset', [AssetSettingController::class, 'storeUserAsset'])->name('assetssetting.storeUserAsset');
Route::put('/assets/assetssetting/userasset/{id}', [AssetSettingController::class, 'updateUserAsset'])->name('assetssetting.updateUserAsset');
Route::delete('/assets/assetssetting/userasset/{id}', [AssetSettingController::class, 'deleteUserAsset'])->name('assetssetting.deleteUserAsset');

//maintenance
Route::get ('/maintenance/list', [MaintenanceController::class,'list'])->name('maintenance.list');
Route::get('/maintenance/add', [MaintenanceController::class, 'add'])->name('maintenance.add');
Route::post('/maintenance/add', [MaintenanceController::class, 'insert'])->name('maintenance.add');
Route::get('/maintenance/edit/{id}', [MaintenanceController::class, 'edit'])->name('maintenance.edit');
Route::post('/maintenance/edit/{id}', [MaintenanceController::class, 'update'])->name('maintenance.edit');
Route::post('/maintenance/delete/{id}', [MaintenanceController::class, 'delete'])->name('maintenance.delete');
Route::get('/maintenance/view/{id}', [MaintenanceController::class, 'view'])->name('maintenance.view');

//disposal
Route::get('/disposal/list', [DisposalController::class,'list'])->name('disposal.list');
Route::get('/disposal/add', [DisposalController::class, 'add'])->name('disposal.add');
Route::post('/disposal/add', [DisposalController::class, 'insert'])->name('disposal.add');
Route::get('/disposal/edit/{id}', [DisposalController::class, 'edit'])->name('disposal.edit');
Route::post('/disposal/edit/{id}', [DisposalController::class, 'update'])->name('disposal.edit');
Route::post('/disposal/delete/{id}', [DisposalController::class, 'delete'])->name('disposal.delete');
Route::get('/disposal/view/{id}', [DisposalController::class, 'view'])->name('disposal.view');

//relocatiom
Route::get('/relocation/list', [RelocationController::class,'list'])->name('relocation.list');
Route::get('/relocation/add', [RelocationController::class, 'add'])->name('relocation.add');
Route::post('/relocation/add', [RelocationController::class, 'insert'])->name('relocation.add');
Route::get('/relocation/edit/{id}', [RelocationController::class, 'edit'])->name('relocation.edit');
Route::post('/relocation/edit/{id}', [RelocationController::class, 'update'])->name('relocation.edit');
Route::post('/relocation/delete/{id}', [RelocationController::class, 'delete'])->name('relocation.delete');
Route::get('/relocation/view/{id}', [RelocationController::class, 'view'])->name('relocation.view');


Route::get('/get-ajax-data/assets_by_category/{id}', [AssetsController::class, 'getAssetsByCategory'])->name('assets.byCategory');
Route::get('/assets/history/{id}', [App\Http\Controllers\AssetsController::class, 'history'])->name('assets.history');


});


