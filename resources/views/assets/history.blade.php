@extends('layouts.app')

@section('content')
@php
$header_title = 'View History';
@endphp
<div class="page-heading">
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

<div class="page-content">

    {{-- STATUS HISTORY --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Status History</div>
        <div class="card-body">
            @if($getHistory->isEmpty())
                <p>No status history available.</p>
            @else
                <table  class="table table-hover -middle text-center" id="table1">
                    <thead class="table-primary">
                        <tr>
                            <th>Status</th>
                            <th>Assigned To</th>
                            <th>Remarks</th>
                            <th>Updated At</th>
                            <th>Changed By</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getHistory as $history)
                            <tr>
                                <td>{{ $history->status->status_type ?? '-' }}</td>
                                <td>{{ $history->assignedUser->name ?? '-' }}</td>
                                <td>{{ $history->remarks ?? '-' }}</td>
                                <td>{{ $history->created_at ? \Carbon\Carbon::parse($history->created_at)->format('d M Y, H:i') : '-' }}</td>
                                <td>{{ $history->changedByUser->name ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- MAINTENANCE HISTORY --}}
    <div class="card mb-4">
        <div class="card-header bg-success text-white">Maintenance History</div>
        <div class="card-body">
            <div class="table-responsive">
                @if($getRecord->maintenances->isEmpty())
                    <p>No maintenance history available.</p>
                @else
                    <table class="table table-hover -middle text-center" id="table1">
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

    {{--RELOCATION HISTORY --}}
    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">Relocation History</div>
        <div class="card-body">
            <div class="table-responsive">
                @if($getRecord->relocations->isEmpty())
                    <p>No relocation history available.</p>
                @else
                    <table class="table table-hover -middle text-center" id="table1">
                        <thead class="table-primary">
                            <tr>
                                <th>Relocation Date</th>
                                <th>From Location</th>
                                <th>From User</th>
                                <th>To Location</th>
                                <th>To User</th>
                                <th>Reason</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getRecord->relocations as $history)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($history->relocation_date)->format('d-m-Y') }}</td>
                                    <td>{{ $getRecord->location->locations_name ?? '-' }}</td>
                                    <td>{{ $history->newLocation->locations_name ?? '-' }}</td>
                                    <td>{{ $getRecord->user->name ?? '-' }}</td>
                                    <td>{{ $history->newUser->name ?? '-' }}</td>
                                    <td>{{ $history->reason ?? '-' }}</td>
                                    <td>
                                        @if($history->attachment)
                                            <a href="{{ asset('upload/disposal_docs/' . $history->support_doc) }}" 
                                            target="_blank" 
                                            class="btn btn-sm btn-outline-primary">
                                                View / Download
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    {{-- DISPOSAL HISTORY --}}
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">Disposal History</div>
        <div class="card-body">
            <div class="table-responsive">
                @if($getRecord->disposals->isEmpty())
                    <p>No disposal history available.</p>
                @else
                    <table class="table table-hover -middle text-center" id="table1">
                        <thead class="table-primary">
                            <tr>
                                <th>Disposal Date</th>
                                <th>Disposal Reason</th>
                                <th>Disposal Method</th>
                                <th>Attachment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getRecord->disposals as $history)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($history->date)->format('d-m-Y') }}</td>
                                    <td>{{ $history->disposal_reason ?? '-' }}</td>
                                    <td>{{ $history->disposal_method ?? '-' }}</td>
                                    <td>
                                        @if($history->support_doc)
                                            <a href="{{ asset('upload/disposal_docs/' . $history->support_doc) }}" 
                                            target="_blank" 
                                            class="btn btn-sm btn-outline-primary">
                                                View / Download
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="text-sm-center mt-4 d-flex justify-content-center">
         <a href="{{ url('/assets/list') }}" class="btn btn-secondary ms-2">Back</a>
    </div>
</div>
@endsection
