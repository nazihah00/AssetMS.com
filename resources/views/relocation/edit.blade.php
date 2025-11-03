@extends('layouts.app')
@section('content')
<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3> Asset Relocation/Transfer</h3>
                            <p class="text-subtitle text-muted">Edit asset relocation here.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Asset Relocation/Transfer</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @php
                $header_title = 'Asset Relocation';
                @endphp

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">Please check the form for errors.</div>
                @endif

                <form action="{{ url('/relocation/edit/'.base64_encode($getRecord->id)) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="section">
                        <div class="card"> 
                            <div class="card-header">
                                <h4 class="card-title">Relocation Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_assets_id">Category Asset<span class="text-danger">*</span></label>
                                                <select class="form-control" name="category_assets_id" id="assets_category_assets_id" required>
                                                    <option value="">Select Category Assets</option>
                                                    @foreach ($getCategoryAsset as $categoryasset)
                                                    <option {{ ($getRecord -> category_assets_id  == $categoryasset->id) ? 'selected' : ''}} value="{{$categoryasset->id}}">{{$categoryasset -> category_type}}</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="asset_id">Asset<span class="text-danger">*</span></label>
                                                <select class="form-control" id="asset_id" name="asset_id" required>
                                                    <option value="">Select Assets</option> 
                                                </select>
                                            </div>
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="new_user_id">New User<span class="text-danger">*</span></label>
                                            <select class="form-control" name="new_user_id" id="new_user_id" required>
                                                    <option value="">Select New User</option>
                                                    @foreach ($getUserAsset as $user)
                                                        <option  {{ ($getRecord -> new_user_id  == $user->id) ? 'selected' : ''}} value="{{$user->id}}"> {{$user->name}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label for="new_location_id">New Location<span class="text-danger">*</span></label>
                                            <select class="form-control" id="new_location_id" name="new_location_id" required>
                                                <option value="">Select New Location</option>
                                                @foreach ($getLocation as $location)
                                                    <option {{ ($getRecord -> new_location_id  == $location->idlocations) ? 'selected' : ''}} value="{{$location->idlocations}}"> {{$location->locations_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="relocation_date">Relocation Date<span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="relocation_date" value="{{ old('relocation_date', $getRecord->relocation_date) }}" name="relocation_date" required placeholder="Enter Cost">
                                            <span class="text-danger">{{ $errors->first('relocation_date') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group"> 
                                            <label for="reason">Reason<span class="text-danger">*</span></label> 
                                            <textarea class="form-control" id="reason"  name="reason">{{ old('reason', $getRecord->reason) }}</textarea> 
                                            <span class="text-danger">{{ $errors->first('reason') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6"> 
                                        <div class="form-group"> 
                                            <label for="attachment">Attachment</label> 
                                            @if($getRecord->attachment )
                                                <p>
                                                    Current file:
                                                    <a href="{{ asset('upload/relocation_docs/' . $getRecord->attachment) }}" target="_blank">
                                                        View / Download File
                                                    </a>
                                                </p>
                                            @endif
                                            <input type="file" class="form-control" id="attachment" name="attachment"  placeholder="Enter supporting document">
                                            <span class="text-danger">{{ $errors->first('attachment') }}</span>
                                        </div>
                                    </div> 
                                </div>                                                                                                                                                                                                                                                                                                                             
                            </div>
                        </div>
                    </section>
                        <div class="text-sm-center mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-2">Update</button>  
                            <a href="{{ url('/relocation/list') }}" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#asset_id').select2({
        placeholder: "Search assets...",
        allowClear: true,
        width: '100%'
    });
    function loadAssets(categoryId, selectedAssetId = null) {
        if(categoryId){
            $.ajax({
                url: '{{ url("get-ajax-data/assets_by_category") }}/' + categoryId,
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    $('#asset_id').html('<option>Loading...</option>');
                },
                success: function(data) {
                    $('#asset_id').empty().append('<option value="">Select Assets</option>');

                    $.each(data, function(key, asset){
                        var brandName = asset.brand ? asset.brand.brands_name : '';
                        var model         = asset.assets_model ?? '';
                        var spec          = asset.assets_specification ?? '';
                        var serial        = asset.assets_serial_num ?? '';
                        var locationName  = asset.location ? asset.location.locations_name : 'No location';
                        var userName      = asset.user ? asset.user.name : 'No user';
                        var selected = (selectedAssetId == asset.idasset) ? 'selected' : '';
                        
                        $('#asset_id').append(
                            '<option value="'+ asset.idasset +'" '+ selected +'>' 
                            + brandName + ' ' + model
                            + ' ' + spec
                            + ' (SN: ' + serial + ')'
                            + ' — ' + locationName
                            + ' — ' + userName
                            + '</option>'
                        );
                    });
                },
                error: function(xhr, status, error){
                    console.error("AJAX Error:", xhr.responseText);
                    alert("Something went wrong: " + error);
                }
            });
        } else {
            $('#asset_id').html('<option value="">Select Assets</option>');
        }
    }

    // bila user tukar category
    $('#assets_category_assets_id').on('change', function() {
        var categoryId = $(this).val();
        loadAssets(categoryId);
    });

    // masa page load → auto call ikut record lama
    var oldCategoryId = "{{ $getRecord->category_assets_id }}";
    var oldAssetId    = "{{ $getRecord->asset_id }}";

    if(oldCategoryId){
        loadAssets(oldCategoryId, oldAssetId);
    }
});
</script>


@endsection