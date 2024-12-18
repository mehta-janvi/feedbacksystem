<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>Login</title>
    <link rel="icon" href="">
    <style>
        a:hover {
            text-decoration: none;
        }

        /* Ensure the section takes full screen and background is properly displayed */
        section {
    background-image: url('{{ asset('assets/images/background.jfif') }}');
    background-size: cover;  /* Ensures the image fills the section */
    background-position: center center;  /* Centers the image */
    background-repeat: no-repeat;  /* Prevents the image from repeating */
    height: 100vh;  /* Full height of the viewport */
    width: 100%; /* Full width */
    display: flex;
    justify-content: center;  /* Centers content horizontally */
    align-items: center;  /* Centers content vertically */
    filter: none;  /* Ensure no blur or other filters are applied */
}

    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 5px;">
                        <div class="card-body p-4 text-center">
                            <img src="{{ asset('assets/images/login.jfif') }}" width="70" height="70" alt="Login Icon">
                            <h3 class="mt-4 mb-1" style="color:#f77b0b">Welcome To</h3>
                            <div class="mb-3">FeedBack System.</div>

                            <!-- Session Message -->
                            @if (session('message'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <!-- Error Message -->
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <!-- Validation Errors -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{route('admin.login')}}" method="POST">
                                @csrf
                                <div class="form-outline mb-3">
                                    <input type="text" class="form-control form-control-lg" style="font-size:15px;" placeholder="EMAIL" name="email" required>
                                </div>
                                <div class="form-outline mb-3">
                                    <input type="password" class="form-control form-control-lg" style="font-size:15px;" placeholder="PASSWORD" name="password" required>
                                </div>
                                <!-- Checkbox -->
                                <div class="row">
                                    <div class="col-sm-5 form-check mt-3 ml-3 text-left">
                                        <input class="form-check-input" type="checkbox" id="form1Example3">
                                        <label class="form-check-label" for="form1Example3"> Remember me </label>
                                    </div>
                                    <div class="col-sm-6 form-check mt-3 ml-3 text-right">
                                        <a href="" target="_blank" class="text-dark">Forgot Password?</a>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-lg btn-block mt-3" type="submit" style="font-size:17px;background-color:#f77b0b;border-color:#f77b0b">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
