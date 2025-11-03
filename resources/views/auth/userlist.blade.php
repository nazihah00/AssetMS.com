@extends('layouts.app')
@section('content')
@php
$header_title = 'List of Users';
@endphp
<div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>List of Users</h3>
                            <p class="text-subtitle text-muted">For admin to check their list</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">List of Users</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                @include('_message')
                    <section class="section">
                        <div class="card shadow-sm rounded-3">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="fas fa-users me-2"></i> List of Users
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover align-middle text-center" id="table1">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Staff Number</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>User Role</th>
                                                <th>Department</th>
                                                <th>Branch</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($getRecord as $key => $value)
                                            <tr>
                                                <td>{{ $getRecord ->firstItem() + $key }}</td>
                                                <td class="fw-semibold">{{ $value->name }}</td>
                                                <td>{{ $value->staff_num }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->phone_num }}</td>
                                                <td>@if($value->role)
                                                        @php
                                                            $badgeClass = match($value->role->gp_name){
                                                                'IT' => 'info',
                                                                'Normal user' => 'primary',
                                                                'Head of Department' => 'success', 
                                                            };
                                                        @endphp
                                                        <span class="badge bg-{{ $badgeClass }}">
                                                            {{ $value->role->gp_name }}
                                                        </span>
                                                        @else
                                                            <span class="badge bg-secondary">Unknown</span>
                                                    @endif
                                                </td>
                                                <td>{{ $value->department }}</td>
                                                <td>{{ $value->branch }}</td>
                                                <td>
                                                    <a href="{{ url('/auth/edituser/'.base64_encode($value->id)) }}" 
                                                    class="btn btn-outline-info btn-sm" 
                                                    title="Edit">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <form action="{{ route('auth.delete', $value->id) }}" method="POST" 
                                                        style="display:inline;" 
                                                        onsubmit="return confirm('Are you sure you want to delete this user?')">
                                                        @csrf
                                                        <button type="submit" 
                                                            class="btn btn-outline-danger btn-sm" 
                                                            title="Delete">
                                                            <i class="fas fa-xmark"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- Pagination -->
                                <div class="d-flex justify-content-end mt-3">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>
                    </section>

            </div>
        </div>
    </div>
</div>






@endsection