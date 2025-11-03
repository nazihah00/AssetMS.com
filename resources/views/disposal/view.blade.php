@extends('layouts.app')

@section('content')
@php
$header_title = 'View Record Disposal';
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

    {{-- Disposal History --}}
    <div class="card">
        <div class="card-header">
            <h5>Disposal History</h5>
        </div>
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
                                <th>Supporting document</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($getRecord->disposals as $history)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($history->disposal_date)->format('d-m-Y') }}</td>
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
         <a href="{{ url('/disposal/list') }}" class="btn btn-secondary ms-2">Back</a>
    </div>

</div>
@endsection
