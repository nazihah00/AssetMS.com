<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/logo/KSSB.png') }}">
    <title>Login - ICT AssetsMS.com</title>
    <link href="{{ url('https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap') }}" rel="stylesheet">
    <link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/pages/auth.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css') }}">
    <link rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css') }}">
   
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html" class="d-flex align-items-start text-decoration-none">
                            <img src="{{ url('assets/images/logo/KSSB.png') }}" alt="Logo" style="height: 55px; margin-right: 20px;">
                            <div>
                                <h5 class="auth-title mb-0" style="font-size: 30px;">KSSB ICT AssetsMS</h5> 
                                <p style="font-size: 18px; margin-bottom:-20px;">ICT Assets Management System</p>
                            </div>
                        </a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>

                    @include('_message')

                    <!--@if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif-->
                    <form action="{{ url('/auth/login') }}" method="post">
                          @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="Email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="submit" value="Login" required>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">

                        <p><a class="font-bold" href="">Forgot password?</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right" style="position: relative; height: 100vh; overflow: hidden;">
                 <img src="{{ url('assets/images/samples/frontimg.jpg') }}" alt="Background 1" class="img-fluid" style="
                    -webkit-mask-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0));
                    mask-image: linear-gradient(to bottom, rgba(0,0,0,1), rgba(0,0,0,0));">
                    
                    <img src="{{ url('assets/images/samples/building1.jpg') }}" alt="Background 2" class="img-fluid" style="
                    -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0));
                    mask-image: linear-gradient(to top, rgba(0,0,0,1), rgba(0,0,0,0));">

                </div>
            </div>
        </div>

    </div>
</body>

</html>