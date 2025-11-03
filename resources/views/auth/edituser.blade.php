<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/logo/KSSB.png') }}">
    <title>Edit - ICT AssetsMS.com</title>
    <link href="{{ url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap') }}" rel="stylesheet">
    <link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/pages/auth.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css') }}">
   
    <style>
        body {
            background-image: url("{{ url('assets/images/samples/building1.jpg') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 2rem;
            max-width: 500px;
            margin: 2rem auto;
        }

        .auth-logo img {
            height: 55px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-8">
                <div class="auth-card">
                    <div class="auth-logo text-center mb-3">
                        <a href="index.html" class="d-flex align-items-center justify-content-center text-decoration-none">
                            <img src="{{ url('assets/images/logo/KSSB.png') }}" alt="Logo" style="height: 55px; margin-right: 20px;">
                            <div>
                                <h5 class="auth-title mb-0" style="font-size: 30px;">KSSB ICT AssetsMS</h5> 
                                <p style="font-size: 18px; margin-bottom: 0;">ICT Assets Management System</p>
                            </div>
                        </a>
                    </div>
                    
                    <h1 class="auth-title text-center mb-4">Edit User Details</h1>

                    @include('_message')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif



                    <form action="{{ url('/auth/edituser', $getRecord->id) }}" method="post">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="name" class="form-control form-control-xl" value="{{ old('name',$getRecord->name) }}"  placeholder="Name" readonly>
                            <div class="form-control-icon">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="staff_num" class="form-control form-control-xl" value="{{ old('staff_num',$getRecord->staff_num) }}"  placeholder="Staff Number" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person-badge-fill"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="department" class="form-control form-control-xl"  value="{{ old('department',$getRecord->department) }}"  placeholder="Department" required>
                            <div class="form-control-icon">
                                <i class="bi bi-building"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="branch" class="form-control form-control-xl"  value="{{ old('branch',$getRecord->branch) }}" placeholder="Branch" required>
                            <div class="form-control-icon">
                                <i class="bi bi-diagram-3-fill"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="tel" name="phone_num" class="form-control form-control-xl"  value="{{ old('phone_num',$getRecord->phone_num) }}" placeholder="Phone Number" required>
                            <div class="form-control-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <select class="form-control form-control-xl" name="user_role_id" required>
                            <option value="">Select User Role</option>
                                 @foreach($getUserRole as $role)
                                    <option {{ $getRecord -> user_role_id == $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->gp_name}}</option>
                                 @endforeach
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-person-gear"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl"  value="{{ old('email',$getRecord->email) }}" placeholder="Email" readonly>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl"  value="{{ old('password',$getRecord->password) }}" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-2 w-100" name="submit" value="Update" required>
                    </form>
                    
                    <div class="text-center mt-4">
                        <p class="fs-5"><a class="font-bold" href="{{ route('auth.userlist') }}">Back</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>