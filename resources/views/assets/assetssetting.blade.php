@extends('layouts.app')

@section('content')
@php
$header_title = 'Assets Setting';
@endphp
<div class="container">
    <h3 class="mb-4">Assets Setting</h3>
    @include('_message')
    <div class="row">
        {{-- Company --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    Company
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Company Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getCompany as $key => $value)
                                <tr>
                                    <td>{{ $getCompany->firstItem() + $key }}</td>
                                    <td>{{ $value->company_name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editCompanyModal{{ $value->idcompany }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteCompany', $value->idcompany) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this company?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Company -->
                                <div class="modal fade" id="editCompanyModal{{ $value->idcompany }}" tabindex="-1" aria-labelledby="editCompanyModalLabel{{ $value->idcompany }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateCompany', $value->idcompany) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editCompanyModalLabel{{ $value->idcompany }}">Edit Company</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Company Name</label>
                                                        <input type="text" name="company_name" class="form-control" value="{{ $value->company_name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getCompany->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCompanyModal">
                        <i class="fas fa-plus"></i> Add Company
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Add Company -->
        <div class="modal fade" id="addCompanyModal" tabindex="-1" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeCompany') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addCompanyModalLabel">Add Company</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control" id="company_name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Brand --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">
                    Brand
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Brand Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getBrand as $key => $value)
                                <tr>
                                    <td>{{ $getBrand->firstItem() + $key }}</td>
                                    <td>{{ $value->brands_name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editBrandModal{{ $value->id }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteBrand', $value->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this brand?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Brand -->
                                <div class="modal fade" id="editBrandModal{{ $value->id }}" tabindex="-1" aria-labelledby="editBrandModalLabel{{ $value->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateBrand', $value->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editBrandModalLabel{{ $value->id }}">Edit Brand</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Brand Name</label>
                                                        <input type="text" name="brands_name" class="form-control" value="{{ $value->brands_name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getBrand->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                        <i class="fas fa-plus"></i> Add Brand
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Add Brand -->
        <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeBrand') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addBrandModalLabel">Add Brand</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="brands_name" class="form-label">Brand Name</label>
                                <input type="text" name="brands_name" class="form-control" id="brands_name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    <div class="row">
        {{-- Category Assets --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    Category Assets
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Assets Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getCategoryAsset as $key => $value)
                                <tr>
                                    <td>{{ $getCategoryAsset->firstItem() + $key }}</td>
                                    <td>{{ $value->category_type }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryAssetsModal{{ $value->id }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteCategoryAssets', $value->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this category assets?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Company -->
                                <div class="modal fade" id="editCategoryAssetsModal{{ $value->id }}" tabindex="-1" aria-labelledby="editCategoryAssetsModalLabel{{ $value->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateCategoryAssets', $value->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editCategoryAssetsModalLabel{{ $value->id }}">Edit Category Assets</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category Assets Name</label>
                                                        <input type="text" name="category_type" class="form-control" value="{{ $value->category_type }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getCategoryAsset->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryAssetsModal">
                        <i class="fas fa-plus"></i> Add Category Assets
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Add Category Assets -->
        <div class="modal fade" id="addCategoryAssetsModal" tabindex="-1" aria-labelledby="addCategoryAssetsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeCategoryAssets') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addCategoryAssetsModalLabel">Add Category Assets</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="category_type" class="form-label">Category Assets Name</label>
                                <input type="text" name="category_type" class="form-control" id="category_type" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Location --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    Location
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Location Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getLocation as $key => $value)
                                <tr>
                                    <td>{{ $getLocation->firstItem() + $key }}</td>
                                    <td>{{ $value->locations_name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editLocationModal{{ $value->idlocations }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteLocation', $value->idlocations) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this location?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Location -->
                                <div class="modal fade" id="editLocationModal{{ $value->idlocations }}" tabindex="-1" aria-labelledby="editLocationModalLabel{{ $value->idlocations }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateLocation', $value->idlocations) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editLocationModalLabel{{ $value->idlocations }}">Edit Location</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Location Name</label>
                                                        <input type="text" name="locations_name" class="form-control" value="{{ $value->locations_name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getLocation->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                        <i class="fas fa-plus"></i> Add Location
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Add Location -->
        <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeLocation') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addLocationModalLabel">Add Location</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="locations_name" class="form-label">Location Name</label>
                                <input type="text" name="locations_name" class="form-control" id="locations_name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Category --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    Category
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Category Code</th>
                                <th>Category Description</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getCategory as $key => $value)
                                <tr>
                                    <td>{{ $getCategory->firstItem() + $key }}</td>
                                    <td>{{ $value->categories_code }}</td>
                                    <td>{{ $value->categories_desc }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $value->idcategories }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteCategory', $value->idcategories) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this category?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Category -->
                                <div class="modal fade" id="editCategoryModal{{ $value->idcategories }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $value->idcategories }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateCategory', $value->idcategories) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editCategoryModalLabel{{ $value->idcategories }}">Edit Category</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Category Code</label>
                                                        <input type="text" name="categories_code" class="form-control" value="{{ $value->categories_code }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Category Description</label>
                                                        <input type="text" name="categories_desc" class="form-control" value="{{ $value->categories_desc }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getCategory->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        <i class="fas fa-plus"></i> Add Category
                    </button>
                </div>
            </div>
        </div>

        <!-- Modal Add Category -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeCategory') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="category_type" class="form-label">Category Code</label>
                                <input type="text" name="categories_code" class="form-control" id="categories_code" required>
                            </div>
                            <div class="mb-3">
                                <label for="category_type" class="form-label">Category Description</label>
                                <input type="text" name="categories_desc" class="form-control" id="categories_desc" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Service Type --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Service Type
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Service Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getService as $key => $value)
                                <tr>
                                    <td>{{ $getService->firstItem() + $key }}</td>
                                    <td>{{ $value->type }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editServiceModal{{ $value->id }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteService', $value->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this service type?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Service Type -->
                                <div class="modal fade" id="editServiceModal{{ $value->id }}" tabindex="-1" aria-labelledby="editServiceModalLabel{{ $value->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateService', $value->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editServiceModalLabel{{ $value->id }}">Edit Service Type</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Service Type</label>
                                                        <input type="text" name="type" class="form-control" value="{{ $value->type }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getService->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                        <i class="fas fa-plus"></i> Add Service Type
                    </button>
                </div>
            </div>
        </div>
         <!-- Modal Add Service Type -->
         <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeService') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addServiceModalLabel">Add Service Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="service_name" class="form-label">Service Type</label>
                                <input type="text" name="type" class="form-control" id="type" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- Vendor --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    Vendor
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Vendor Name</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getVendor as $key => $value)
                                <tr>
                                    <td>{{ $getVendor->firstItem() + $key }}</td>
                                    <td>{{ $value->vendors_name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editVendorModal{{ $value->idvendors }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteVendor', $value->idvendors) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this vendor?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Vendor -->
                                <div class="modal fade" id="editVendorModal{{ $value->idvendors }}" tabindex="-1" aria-labelledby="editVendorModalLabel{{ $value->idvendors }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateVendor', $value->idvendors) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editVendorModalLabel{{ $value->idvendors }}">Edit Vendor</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Vendor Name</label>
                                                        <input type="text" name="vendors_name" class="form-control" value="{{ $value->vendors_name }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getVendor->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addVendorModal">
                        <i class="fas fa-plus"></i> Add Vendor
                    </button>
                </div>
            </div>
        </div>
         <!-- Modal Add Vendor -->
        <div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeVendor') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addVendorModalLabel">Add Vendor</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status_name" class="form-label">Vendor Name</label>
                                <input type="text" name="vendors_name" class="form-control" id="vendors_name" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- Status --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    Status
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Status Type</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getStatus as $key => $value)
                                <tr>
                                    <td>{{ $getStatus->firstItem() + $key }}</td>
                                    <td>{{ $value->status_type }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editStatusModal{{ $value->idstatus }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteStatus', $value->idstatus) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this status?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit Status -->
                                <div class="modal fade" id="editStatusModal{{ $value->idstatus }}" tabindex="-1" aria-labelledby="editStatusModalLabel{{ $value->idstatus }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateStatus', $value->idstatus) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editStatusModalLabel{{ $value->idstatus }}">Edit Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Status Type</label>
                                                        <input type="text" name="status_type" class="form-control" value="{{ $value->status_type }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getStatus->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                        <i class="fas fa-plus"></i> Add Status
                    </button>
                </div>
            </div>
        </div>
         <!-- Modal Add Status -->
         <div class="modal fade" id="addStatusModal" tabindex="-1" aria-labelledby="addStatusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeStatus') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addStatusModalLabel">Add Status</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status_name" class="form-label">Status Type</label>
                                <input type="text" name="status_type" class="form-control" id="status_type" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
    {{--User Asset--}}
        <div class="col-md-12 mb-8">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    User Assigned to Asset
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getUserAsset as $key => $value)
                                <tr>
                                    <td>{{ $getUserAsset->firstItem() + $key }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->dept }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#editUserAssetModal{{ $value->id }}"><i class="fas fa-pen"></i></button>
                                        <!-- Delete button -->
                                        <form action="{{ route('assetssetting.deleteUserAsset', $value->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-xmark"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                 <!-- Modal Edit User Asset -->
                                <div class="modal fade" id="editUserAssetModal{{ $value->id }}" tabindex="-1" aria-labelledby="ediUserAssetrModalLabel{{ $value->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('assetssetting.updateUserAsset', $value->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title" id="editUserAssetModalLabel{{ $value->id }}">Edit User Asset</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $value->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Department</label>
                                                        <input type="text" name="dept" class="form-control" value="{{ $value->dept }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- pagination -->
                    <div class="mt-2 d-flex justify-content-end">
                        {{ $getUserAsset->links() }}
                    </div>
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addUserAssetModal">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                </div>
            </div>
        </div>
         <!-- Modal Add User Asset -->
         <div class="modal fade" id="addUserAssetModal" tabindex="-1" aria-labelledby="addUserAssetModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('assetssetting.storeUserAsset') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="addUserAssetModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="dept" class="form-label">Department</label>
                                <input type="text" name="dept" class="form-control" id="dept" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
