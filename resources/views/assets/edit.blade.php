@extends('layouts.app')
@section('content')
@include('_message')
<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3> Edit Assets</h3>
                            <p class="text-subtitle text-muted">Add new assets here.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Assets</li>
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

                @if($errors->any())
                    <div class="alert alert-danger">Please check the form for errors.</div>
                @endif

                <form action="{{ url('/assets/edit', $getRecord->idasset) }}" method="post" enctype="multipart/form-data">
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
                                            <label for="assets_brand_id">Brand<span class="text-danger">*</span></label>
                                            <select class="form-control" name="assets_brand_id" required>
                                                <option value="">Select Brand</option>
                                                @foreach ($getBrand as $brand)
                                                    <option {{ ($getRecord -> assets_brand_id  == $brand->id) ? 'selected' : ''}} value="{{$brand->id}}">{{$brand -> brands_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_model">Model<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('assets_model', $getRecord->assets_model)}}" name="assets_model" required placeholder="Enter model">
                                            <span class="text-danger">{{ $errors->first('assets_model') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_specification">Specification<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('assets_specification', $getRecord->assets_specification) }}" name="assets_specification" required placeholder="Enter specification">
                                            <span class="text-danger">{{ $errors->first('assets_specification') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                    <div class="form-group">
                                            <label for="assets_category_assets_id">Category Asset<span class="text-danger">*</span></label>
                                            <select class="form-control" name="assets_category_assets_id" required>
                                                <option value="">Select  Category Assets</option>
                                                @foreach ($getCategoryAsset as $categoryasset)
                                                    <option {{ ($getRecord -> assets_category_assets_id  == $categoryasset->id) ? 'selected' : ''}} value="{{$categoryasset->id}}">{{$categoryasset -> category_type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                                            <label for="assets_company_id">Company<span class="text-danger">*</span></label>
                                            <select class="form-control" name="assets_company_id" required>
                                                <option value="">Select Company</option>
                                                @foreach ($getCompany as $company)
                                                    <option {{ ($getRecord -> assets_company_id  == $company->idcompany) ? 'selected' : ''}} value="{{$company->idcompany}}">{{$company -> company_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">   
                                            <label for="assets_type">Type<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('assets_type', $getRecord->assets_type) }}" name="assets_type" required placeholder="Enter type">
                                            <span class="text-danger">{{ $errors->first('assets_type') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_category_id">Category<span class="text-danger">*</span></label>
                                            <select class="form-control" name="assets_category_id" required>
                                                <option value="">Select Category</option>
                                                @foreach ($getCategory as $categories)
                                                <option {{ ($getRecord -> assets_company_id == $categories->idcategories) ? 'selected' : '' }} value="{{ $categories->idcategories }}">{{$categories -> categories_code}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_running_num">Running number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('assets_running_num', $getRecord->assets_running_num) }}" name="assets_running_num" required placeholder="Enter running number">
                                            <span class="text-danger">{{ $errors->first('assets_running_num') }}</span>
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
                                            <label for="assets_serial_num">Serial Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('assets_serial_num', $getRecord->assets_serial_num) }}" name="assets_serial_num" required placeholder="Enter serial number">
                                            <span class="text-danger">{{ $errors->first('assets_serial_num') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_location_id">Location<span class="text-danger">*</span></label>
                                            <select class="form-control" name="assets_location_id" required>
                                                <option value="">Select Location</option>
                                                @foreach ($getLocation as $locations)
                                                    <option {{ ($getRecord -> assets_location_id == $locations->idlocations)  ? 'selected' : ''}} value="{{ $locations -> idlocations}}">{{ $locations->locations_name  }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('assets_location_id') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">   
                                            <label for="assets_assigned_id">Assigned to<span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="assets_assigned_user_id" required>
                                                <option value="">Select User</option>
                                                @foreach($getUserAsset as $users)
                                                    <option {{ ($getRecord -> assets_assigned_user_id == $users -> id) ? 'selected' : ''}} value="{{ $users -> id}}">{{ $users->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('assets_assigned_user_id') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_PO_num">PO Number<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('assets_PO_num', $getRecord->assets_PO_num) }}" name="assets_PO_num" placeholder="Enter PO number">
                                            <span class="text-danger">{{ $errors->first('assets_PO_num') }}</span>
                                        </div>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_handover_date">Handover Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" value="{{ old('assets_handover_date', $getRecord->assets_handover_date) }}" name="assets_handover_date" placeholder="Enter handover date">
                                            <span class="text-danger">{{ $errors->first('assets_handover_date') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_purchase_cost">Purchase Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" value="{{ old('assets_purchase_cost', $getRecord->assets_purchase_cost) }}" name="assets_purchase_cost" placeholder="Enter purchase price">
                                            <span class="text-danger">{{ $errors->first('assets_purchase_cost') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_purchase_date">Purchase Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" value="{{ old('assets_purchase_date', $getRecord->assets_purchase_date) }}" name="assets_purchase_date" placeholder="Enter purchase date">
                                            <span class="text-danger">{{ $errors->first('assets_purchase_date') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_vendor">Vendor<span class="text-danger">*</span></label>
                                            <select class="form-control" value="{{ old('assets_vendor_id') }}" name="assets_vendor_id" required>
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
                                            <label for="assets_warranty_expiry">Expiry Warranty Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" value="{{ old('assets_warranty_expiry', $getRecord->assets_warranty_expiry) }}" name="assets_warranty_expiry" placeholder="Enter expiry warranty date">
                                            <span class="text-danger">{{ $errors->first('assets_warranty_expiry') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="assets_status_id">Status<span class="text-danger">*</span></label>
                                            <select class="form-control" value="{{ old('assets_status_id') }}" name="assets_status_id" required>
                                                @foreach($getStatus as $status)
                                                    <option {{ ($getRecord -> assets_status_id == $status -> idstatus) ? 'selected' : ''}} value="{{ $status -> idstatus}}">{{ $status->status_type }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{ $errors->first('assets_status_id') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Attachment (Optional)</label>

                                            {{-- Tunjuk file lama kalau ada --}}
                                            @if($getRecord->assets_supporting_doc)
                                                <p>
                                                    Current file:
                                                    <a href="{{ asset('upload/assets_docs/' . $getRecord->assets_supporting_doc) }}" target="_blank">
                                                        View / Download
                                                    </a>
                                                </p>
                                            @endif

                                            {{-- Input untuk upload baru --}}
                                            <input type="file" name="assets_supporting_doc" class="form-control">
                                            <small class="text-muted">Leave empty if you don’t want to change the file.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                                                                                                                                                                                                                                                                              
                        </div>
                        </section>
                        <div class="text-sm-center mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-2">Update</button>  
                            <a href="{{ url('/assets/list') }}" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: 'Search or select an option...',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush
