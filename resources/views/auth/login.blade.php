
<!doctype html>
<html lang="en">

<head>
<title>Login</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="Lucid Bootstrap 4.1.1 Admin Template">
<meta name="author" content="WrapTheme, design by: ThemeMakker.com">

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/main.css">
<link rel="stylesheet" href="{{asset('backend')}}/assets/css/color_skins.css">
</head>

<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 col-12">
            <div class="card">
                <div class="card-header"></div>
					<div class="card">
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                                <!-- <div class="form-group">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login For</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);">Admin</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Professors</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Student</a>
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                                <div class="form-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              
                            
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                         
                               
                                <!-- <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button> -->
                                <div class="bottom mt-3">
                                <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                                    <!-- <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span> -->
                                    <!-- <span>Don't have an account? <a href="page-register.html">Register</a></span> -->
                                </div>
                            </form>
                        </div>
                    </div>
                
                    </div>

				</div>
			</div>
		</div>
        </div>
    <!-- END WRAPPER -->
    
    <!-- Javascript -->
<script src="{{asset('backend')}}/assets/bundles/libscripts.bundle.js"></script>    
<script src="{{asset('backend')}}/assets/bundles/vendorscripts.bundle.js"></script>
    
<script src="{{asset('backend')}}/assets/bundles/mainscripts.bundle.js"></script>
</body>
</html>
