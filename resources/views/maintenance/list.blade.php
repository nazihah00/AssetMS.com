@extends('layouts.app')
@section('content')
@php
    $header_title = 'List of Maintenance';
    @endphp

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List of Maintenance and Report</h3>
                <p class="text-subtitle text-muted">For user to check their list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List of Maintenance and Report</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    @include('_message')
    <section class="section">
        <div class="card">
            <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="bi bi-stack me-2"></i>
                    <span>List of Maintenance and Report</span>
                </div>
                <div class="d-flex align-items-center">
                    {{-- Search Box --}}
                    <form method="GET" action="{{ url('/assets/list') }}" class="d-flex align-items-center me-2">
                        <input type="text" name="search" value="{{ Request::get('search') }}"
                            class="form-control form-control me-1" placeholder="Search records...">
                            <button type="submit" class="btn btn-light me-1">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(Request::get('search'))
                                <a href="{{ url('/maintenance/list') }}" class="btn btn-outline-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                             @endif
                    </form>

                    {{-- Register Button --}}
                    <a href="{{ url('/maintenance/add') }}" class="btn btn-light btn-register mr-2">
                        <i class="fas fa-plus text-primary"></i>
                        <span class="ms-1 text-primary">Register Maintenance</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-left" id="table1">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Assets Detail</th>
                                <th>Location</th>
                                <th>User</th>
                                <th>Latest Maintenance Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($getRecord as $key => $value)
                            <tr>
                                <td>{{ $getRecord ->firstItem() + $key  }}</td>
                                <td>
                                    {{ $value->asset->brand->brands_name ?? '' }} {{ $value->asset->assets_model ?? '' }} {{ $value->asset->assets_specification ?? '' }}
                                    (SN: {{ $value->asset->assets_serial_num ?? '' }})
                                </td>
                                <td>{{ $value->asset->location->locations_name ?? '-' }}</td>
                                <td>{{ $value->asset->user->name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($value->date)->format('d-m-Y') }}</td>
                                <td class="text-right">
                                    <!-- <a href="{{ url('/maintenance/view/'.base64_encode($value->asset_id)) }}" class="btn btn-outline-success btn-sm mb-1" title="View">
                                        <i class="fas fa-list"></i>
                                    </a> -->
                                    <a href="{{ url('/maintenance/edit/'.base64_encode($value->idmaintenance)) }}" class="btn btn-outline-dark btn-sm mb-1" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('maintenance.delete', $value->idmaintenance) }}" method="POST" 
                                                    style="display:inline;" 
                                                    onsubmit="return confirm('Are you sure you want to delete this?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm  mb-1" title="Delete">
                                                        <i class="fas fa-xmark"></i>
                                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table> 
                </div>
                <div style="padding: 10px; float: right;">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
