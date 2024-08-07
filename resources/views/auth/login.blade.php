<!doctype html>
<html lang="en" dir="ltr">
  <head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Rotary – Bootstrap  Admin & Dashboard Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{URL::asset('assets/assets/images/brand/favicon.ico')}}" />

		<!-- TITLE -->
		<title>Membership Management System</title>

		<!-- BOOTSTRAP CSS -->
		<link href="{{URL::asset('assets/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{URL::asset('assets/assets/css/style.css')}}" rel="stylesheet"/>
		<link href="{{URL::asset('assets/assets/css/dark-style.css')}}" rel="stylesheet"/>
		<link href="{{URL::asset('assets/assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!-- SIDE-MENU CSS -->
		<link href="{{URL::asset('assets/assets/css/sidemenu.css')}}" rel="stylesheet" id="sidemenu-theme">

		<!-- SINGLE-PAGE CSS -->
		<link href="{{URL::asset('assets/assets/plugins/single-page/css/main.css')}}" rel="stylesheet" type="text/css">

		<!--C3 CHARTS CSS -->
		<link href="{{URL::asset('assets/assets/plugins/charts-c3/c3-chart.css')}}" rel="stylesheet"/>

		<!-- P-scroll bar css-->
		<link href="{{URL::asset('assets/assets/plugins/p-scroll/perfect-scrollbar.css')}}" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="{{URL::asset('assets/assets/css/icons.css')}}" rel="stylesheet"/>

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{URL::asset('assets/assets/colors/color1.css')}}" />

	</head>

	<body>

		<!-- BACKGROUND-IMAGE -->
		<div class="login-img">

			<!-- GLOABAL LOADER -->
			<div id="global-loader">
				<img src="{{URL::asset('assets/assets/images/loader.svg')}}" class="loader-img" alt="Loader">
			</div>
			<!-- /GLOABAL LOADER -->

			<!-- PAGE -->
			<div class="page">
				<div class="">
				    <!-- CONTAINER OPEN -->
					<div class="col col-login mx-auto">
						<div class="text-center">
							<!--<img src="{{URL::asset('assets/assets/images/brand/logo.png')}}" class="header-brand-img" alt="">-->
							<img src="{{URL::asset('assets/assets/images/brand/logo1.png')}}" class="header-brand-img" alt="ORGANIZATION LOGO">
						</div>
					</div>
					<div class="container-login100">
						<div class="wrap-login100 p-0">
							<div class="card-body">
                                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group" >
                                       <div class="input-group mb-4">
                                       
                    
                                        <input id="username" placeholder="Username" style="width:100%" type="text" class="input100 @error('username') is-invalid @enderror"
                                            name="username" value="{{ old('username') }}" required autocomplete="username">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="zmdi zmdi-assignment-account" aria-hidden="true"></i>
                                            </span>
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-4">
                                            <!--<div class="col" >-->
                                            <!--    <label for="password">Password</label>-->
                                            <!--</div>-->
                                            
                
                                            
                                        
                                        
                                       
                                        <input id="password" type="password" style="width:100%" placeholder="Password"
                                        class="input100 @error('password') is-invalid @enderror" name="password" required
                                            autocomplete="current-password">
                                            <span class="focus-input100"></span>
										<span class="symbol-input100">
											<i class="zmdi zmdi-lock" aria-hidden="true"></i>
										</span>
                
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary account-btn" style="width:100%" type="submit"><font color="white">Login</font></button>
                                    </div>
                                    <div class="col-auto">                                
                                                @if (Route::has('password.request'))
                                                    {{-- <a class="text-primary" href="{{ route('password.request') }}">
                                                        Forgot password ? 
                                                    </a>  --}}
													Not an administrator? <a class="text-primary" href="{{ route('tenant.login') }}">
                                                       Login as a Member
                                                    </a>
                                                @endif
                                            </div>
                                    {{-- <div class="account-footer">
                                        <p>Don't have an account yet? <a href="">Register</a></p>
                                    </div> --}}
                                </form>
							</div>
							{{-- <div class="card-footer">
								<div class="d-flex justify-content-center my-3">
									<a href="" class="social-login  text-center me-4">
										<i class="fa fa-google"></i>
									</a>
									<a href="" class="social-login  text-center me-4">
										<i class="fa fa-facebook"></i>
									</a>
									<a href="" class="social-login  text-center">
										<i class="fa fa-twitter"></i>
									</a>
								</div>
							</div> --}}
						</div>
					</div>
					<!-- CONTAINER CLOSED -->
				</div>
			</div>
			<!-- End PAGE -->

		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- JQUERY JS -->
		<script src="{{URL::asset('assets/assets/js/jquery.min.js')}}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{URL::asset('assets/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{URL::asset('assets/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

		<!-- SPARKLINE JS -->
		<script src="{{URL::asset('assets/assets/js/jquery.sparkline.min.js')}}"></script>

		<!-- CHART-CIRCLE JS -->
		<script src="{{URL::asset('assets/assets/js/circle-progress.min.js')}}"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="{{URL::asset('assets/assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>

		<!-- INPUT MASK JS -->
		<script src="{{URL::asset('assets/assets/plugins/input-mask/jquery.mask.min.js')}}"></script>

		<!-- CUSTOM JS-->
		<script src="{{URL::asset('assets/assets/js/custom.js')}}"></script>

	</body>
</html>








