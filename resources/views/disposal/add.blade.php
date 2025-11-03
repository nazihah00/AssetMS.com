@extends('layouts.app')
@section('content')
<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3> Assets Disposal</h3>
                            <p class="text-subtitle text-muted">Add new assets disposal here.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Assets Disposal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @php
                $header_title = 'Assets Disposal';
                @endphp

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">Please check the form for errors.</div>
                @endif

                <form action="{{ url('/disposal/add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="section">
                        <div class="card"> 
                            <div class="card-header">
                                <h4 class="card-title">Assets Disposal Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category_assets_id">Category Asset<span class="text-danger">*</span></label>
                                                <select class="form-control" name="category_assets_id" id="assets_category_assets_id" required>
                                                    <option value="">Select Category Assets</option>
                                                    @foreach ($getCategoryAsset as $categoryasset)
                                                        <option value="{{$categoryasset->id}}"> {{$categoryasset->category_type}}</option>
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
                                    <div class="col-md-6"> 
                                        <div class="form-group">
                                            <label for="date">Disposal Date<span class="text-danger">*</span></label> 
                                            <input type="date" class="form-control" id="disposal_date" name="disposal_date" required placeholder="Enter disposal date"> 
                                            <span class="text-danger">{{ $errors->first('date') }}</span>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disposal_reason">Disposal Reason<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="disposal_reason" name="disposal_reason" required placeholder="Enter disposal reason">
                                            <span class="text-danger">{{ $errors->first('time') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="disposal_method">Disposal Method<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="disposal_method" name="disposal_method" required placeholder="Enter disposal method">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="support_doc">Supporting document<span class="text-danger">*</span></label>
                                            <input type="file" class="form-control" id="support_doc" name="support_doc" required placeholder="Enter supporting document">
                                            <span class="text-danger">{{ $errors->first('support_doc') }}</span>
                                        </div>
                                    </div>
                                </div>                                                                                                                                                                                                                                                                                                                             
                            </div>
                        </div>
                    </section>
                        <div class="text-sm-center mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-2">Register</button>  
                            <a href="{{ url('/disposal/list') }}" class="btn btn-secondary ms-2">Cancel</a>
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
    
    $('#assets_category_assets_id').on('change', function() {
        var categoryId = $(this).val();

        if(categoryId){
            $.ajax({
                url: '{{ url("get-ajax-data/assets_by_category") }}/' + categoryId,
                type: "GET",
                dataType: "json",
                beforeSend: function() {
                    $('#asset_id').html('<option>Loading...</option>');
                },
                success: function(data) {
                    console.log("Response Data:", data); 
                    $('#asset_id').empty();
                    $('#asset_id').empty().append('<option value="">Select Assets</option>');

                    $.each(data, function(key, asset){
                        var brandName = asset.brand ? asset.brand.brands_name : '';
                        var model         = asset.assets_model ?? '';
                        var spec          = asset.assets_specification ?? '';
                        var serial        = asset.assets_serial_num ?? '';
                        var locationName  = asset.location ? asset.location.locations_name : 'No location';
                        var userName      = asset.user ? asset.user.name : 'No user';
                        $('#asset_id').append(
                            '<option value="'+ asset.idasset +'">'
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
    });
});
</script>


@endsection