@extends('layouts.app')

@section('content')
@php
$header_title = 'View Record Maintenance';
@endphp
<div class="container">

    {{-- Asset Details --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Asset Details</h5>
        </div>
        <div class="card-body">
            <p><strong>Category:</strong> {{ $getRecord->categoryAsset->category_type ?? '-' }}</p>
            <p><strong>Name:</strong> 
                {{ $getRecord->brand->brands_name ?? '-' }} 
                {{ $getRecord->assets_model ?? '-' }} 
                {{ $getRecord->assets_specification ?? '-' }}
            </p> 
            <p><strong>Code:</strong> 
                {{ $getRecord->company->company_name ?? '-' }}/
                {{ $getRecord->assets_type ?? '-' }}/
                {{ $getRecord->category->categories_code ?? '-' }}/
                {{ $getRecord->assets_running_num ?? '-' }}
            </p>
            <p><strong>User:</strong> {{ $getRecord->user->name ?? '-' }}</p>
            <p><strong>Location:</strong> {{ $getRecord->location->locations_name ?? '-' }}</p>
        </div>
    </div>

    {{-- Maintenance History --}}
    <div class="card">
        <div class="card-header">
            <h5>Maintenance History</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($getRecord->maintenances->isEmpty())
                    <p>No maintenance history available.</p>
                @else
                    <table class="table table-hover align-left" id="table1">
                        <thead class="table-primary">
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Service Type</th>
                                <th>Problem</th>
                                <th>Resolution</th>
                                <th>Vendor/Technician</th>
                                <th>Cost (RM)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getRecord->maintenances as $history)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($history->date)->format('d-m-Y') }}</td>
                                    <td>{{ $history->time ?? '-' }}</td>
                                    <td>{{ $history->service->type ?? '-' }}</td>
                                    <td>{{ $history->problem_desc ?? '-' }}</td>
                                    <td>{{ $history->resolution ?? '-' }}</td>
                                    <td>{{ $history->vendor->vendors_name ?? '-' }}</td>
                                    <td>{{ number_format($history->cost, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

    </div>
    <div class="text-sm-center mt-4 d-flex justify-content-center">
         <a href="{{ url('/maintenance/list') }}" class="btn btn-secondary ms-2">Back</a>
    </div>

</div>
@endsection
