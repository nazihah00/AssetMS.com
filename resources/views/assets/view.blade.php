@extends('layouts.app')
@section('content')

<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3> View Details and History</h3>
                            <p class="text-subtitle text-muted">View details of assets here.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">View Assets</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @php
                $header_title = 'Edit Assets';
                @endphp

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())lk
                    <div class="alert alert-danger">Please check the form for errors.</div>
                @endif

                <form action="{{ url('/assets/view', $getRecord->idasset) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <section class="section">
                        <div class="card"> 
                            <div class="card-header">
                                <h4 class="card-title">Assets Description</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <select class="form-control" disabled>
                                                <option value="">Select Brand</option>
                                                @foreach ($getBrand as $brand)
                                                    <option {{ ($getRecord -> assets_brand_id  == $brand->id) ? 'selected' : ''}} value="{{$brand->id}}">{{$brand -> brands_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Model</label>
                                            <input type="text" class="form-control" value="{{ $getRecord->assets_model }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Specification</label>
                                            <input type="text" class="form-control" value="{{ $getRecord->assets_specification }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Category Assets</label>
                                        <select class="form-control" disabled>
                                            <option value="">Select  Category Assets</option>
                                                @foreach ($getCategoryAsset as $categoryasset)
                                                    <option {{ ($getRecord -> assets_category_assets_id  == $categoryasset->id) ? 'selected' : ''}} value="{{$categoryasset->id}}">{{$categoryasset -> category_type}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h4 class="card-title">Assets Code</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <select class="form-control" disabled>
                                                <option value="">Select Company</option>
                                                @foreach ($getCompany as $company)
                                                    <option {{ ($getRecord -> assets_company_id  == $company->idcompany) ? 'selected' : ''}} value="{{$company->idcompany}}">{{$company -> company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">   
                                            <label>Type</label>
                                            <input type="text" class="form-control" value="{{ $getRecord->assets_type }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" disabled>
                                                <option value="">Select Category</option>
                                                @foreach ($getCategory as $categories)
                                                <option {{ ($getRecord -> assets_company_id == $categories->idcategories) ? 'selected' : '' }} value="{{ $categories->idcategories }}">{{$categories -> categories_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Running number</label>
                                            <input type="text" class="form-control" value="{{ $getRecord->assets_running_num }}" disabled>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="card-header">
                                <h4 class="card-title">Assets Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Serial Number</label>
                                            <input type="text" class="form-control" value="{{  $getRecord->assets_serial_num }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <select class="form-control" disabled>
                                                <option value="">Select Location</option>
                                                @foreach ($getLocation as $locations)
                                                    <option {{ ($getRecord -> assets_location_id == $locations->idlocations)  ? 'selected' : ''}} value="{{ $locations -> idlocations}}">{{ $locations->locations_name  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">   
                                            <label>Assigned User</label> 
                                            <select class="form-control" disabled>
                                                <option value="">Select User</option>
                                                @foreach($getUserAsset as $users)
                                                    <option {{ ($getRecord -> assets_assigned_user_id == $users -> id) ? 'selected' : ''}} value="{{ $users -> id}}">{{ $users->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>PO Number</label>
                                            <input type="text" class="form-control" value="{{  $getRecord->assets_PO_num }}" disabled>
                                        </div>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Handover Date</label>
                                            <input type="date" class="form-control" value="{{ $getRecord->assets_handover_date}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <labe>Purchase Price</label>
                                            <input type="text" class="form-control" value="{{ $getRecord->assets_purchase_cost }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Purchase Date</label>
                                            <input type="date" class="form-control" value="{{ $getRecord->assets_purchase_date }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select class="form-control" disabled>
                                                @foreach($getVendor as $vendor)
                                                    <option {{ ($getRecord -> assets_vendor_id == $vendor -> idvendors) ? 'selected' : ''}} value="{{ $vendor -> idvendors}}">{{ $vendor->vendors_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Expiry Warranty Date</label>
                                            <input type="date" class="form-control" value="{{ $getRecord->assets_warranty_expiry }}" disabled>
                                            <span class="text-danger">{{ $errors->first('assets_warranty_expiry') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" disabled>
                                                @foreach($getStatus as $status)
                                                    <option {{ ($getRecord -> assets_status_id == $status -> idstatus) ? 'selected' : ''}} value="{{ $status -> idstatus}}">{{ $status->status_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Attachment</label>
                                            @if($getRecord->assets_supporting_doc)
                                                <a href="{{ asset('upload/docs/' . $getRecord->assets_supporting_doc) }}" target="_blank">
                                                    View / Download File
                                                </a>
                                            @else
                                                <span>No attachment</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                                                                                                                                                                                                                                                                              
                        </div>
                        </section>
                    </form>
                        <div class="text-sm-center mt-4 d-flex justify-content-center">
                            <a href="{{ url('/assets/list') }}" class="btn btn-secondary ms-2">Back</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection