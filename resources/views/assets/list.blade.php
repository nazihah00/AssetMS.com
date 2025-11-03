@extends('layouts.app')
@section('content')
@php
    $header_title = 'List of Assets';
    @endphp

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>List of Assets</h3>
                <p class="text-subtitle text-muted">For user to check their list</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List of Assets</li>
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
                    <i class="fas fa-boxes me-2"></i>
                    <span>List of Assets</span>
                </div>
                <div class="d-flex align-items-center">
                    {{-- Search Box --}}
                    <form method="GET" action="{{ url('/assets/list') }}" class="d-flex align-items-center me-2">
                        <input type="text" name="search" value="{{ Request::get('search') }}"
                            class="form-control form-control me-1" placeholder="Search assets...">
                            <button type="submit" class="btn btn-light me-1">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(Request::get('search'))
                                <a href="{{ url('/assets/list') }}" class="btn btn-outline-danger">
                                    <i class="fas fa-times"></i>
                                </a>
                             @endif
                    </form>

                    {{-- Register Button --}}
                    <a href="{{ url('/assets/add') }}" class="btn btn-light btn-register mr-2">
                        <i class="fas fa-plus text-primary"></i>
                        <span class="ms-1 text-primary">Register Assets</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center" id="table1">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Code</th>
                                <th>Assigned to</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $key => $value)
                            <tr>
                                <td>{{ $getRecord ->firstItem() + $key }}</td>
                                <td>{{ $value-> categoryasset -> category_type ?? 'N/A'}}</td>
                                <td>{{ $value->brand -> brands_name ?? 'N/A' }} {{ $value->assets_model }} {{ $value->assets_specification }}</td>
                                <td>
                                    {{ $value->company->company_name ?? 'N/A' }}/{{ $value->assets_type }}/{{ $value->category->categories_code ?? 'N/A' }}/{{ $value->assets_running_num }}
                                </td>
                                <td>{{$value->user->name ?? 'N/A' }}</td>                           
                                <td>{{ $value->location->locations_name ?? 'N/A' }}</td>
                                <td>
                                    @if($value->status)
                                        @php
                                            $statusType = strtolower($value->status->status_type); // tukar ke huruf kecil
                                            $badgeClass = match($statusType) {
                                                'new' => 'success',
                                                'in use' => 'primary',
                                                'relocate' => 'info',
                                                'under maintenance' => 'warning',
                                                'disposed' => 'danger',
                                                'to dispose' => 'secondary',
                                                'retired' => 'dark',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">
                                            {{ strtoupper($value->status->status_type) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">UNKNOWN</span>
                                    @endif
                                </td>
                                <td class="text-right" style="width:100px;">
                                    <a href="{{ url('/assets/view/'.base64_encode($value->idasset)) }}" class="btn btn-outline-success btn-sm mb-1" title="View">
                                        <i class="fas fa-list"></i>
                                    </a>
                                    <a href="{{ url('/assets/edit/'.base64_encode($value->idasset)) }}" class="btn btn-outline-dark btn-sm mb-1" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('assets.delete', $value->idasset) }}" method="POST" 
                                                    style="display:inline;" 
                                                    onsubmit="return confirm('Are you sure you want to delete this asset?')">
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger btn-sm  mb-1" title="Delete">
                                                        <i class="fas fa-xmark"></i>
                                                    </button>
                                    </form>
                                    <a href="{{ url('/assets/history/'.base64_encode($value->idasset)) }}" class="btn btn-outline-primary btn-sm mb-1" title="View History">
                                        <i class="fas fa-clock"></i>
                                    </a>                                
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
