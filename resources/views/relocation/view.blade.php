@extends('layouts.app')

@section('content')
@php
$header_title = 'View Record Relocation';
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
        </div>
    </div>

    {{-- Relocation History --}}
    <div class="card">
        <div class="card-header">
            <h5>Relocation History</h5>
        </div>
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
    <div class="text-sm-center mt-4 d-flex justify-content-center">
         <a href="{{ url('/disposal/list') }}" class="btn btn-secondary ms-2">Back</a>
    </div>

</div>
@endsection
