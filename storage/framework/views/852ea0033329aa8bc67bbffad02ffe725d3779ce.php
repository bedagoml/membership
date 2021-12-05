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
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(URL::asset('assets/assets/images/brand/favicon.ico')); ?>" />

		<!-- TITLE -->
		<title>Membership Management System</title>

		<!-- BOOTSTRAP CSS -->
		<link href="<?php echo e(URL::asset('assets/assets/plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="<?php echo e(URL::asset('assets/assets/css/style.css')); ?>" rel="stylesheet"/>
		<link href="<?php echo e(URL::asset('assets/assets/css/dark-style.css')); ?>" rel="stylesheet"/>
		<link href="<?php echo e(URL::asset('assets/assets/css/skin-modes.css')); ?>" rel="stylesheet" />

		<!-- SIDE-MENU CSS -->
		<link href="<?php echo e(URL::asset('assets/assets/css/sidemenu.css')); ?>" rel="stylesheet" id="sidemenu-theme">

		<!-- SINGLE-PAGE CSS -->
		<link href="<?php echo e(URL::asset('assets/assets/plugins/single-page/css/main.css')); ?>" rel="stylesheet" type="text/css">

		<!--C3 CHARTS CSS -->
		<link href="<?php echo e(URL::asset('assets/assets/plugins/charts-c3/c3-chart.css')); ?>" rel="stylesheet"/>

		<!-- P-scroll bar css-->
		<link href="<?php echo e(URL::asset('assets/assets/plugins/p-scroll/perfect-scrollbar.css')); ?>" rel="stylesheet" />

		<!--- FONT-ICONS CSS -->
		<link href="<?php echo e(URL::asset('assets/assets/css/icons.css')); ?>" rel="stylesheet"/>

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="<?php echo e(URL::asset('assets/assets/colors/color1.css')); ?>" />

	</head>

	<body>

		<!-- BACKGROUND-IMAGE -->
		<div class="login-img">

			<!-- GLOABAL LOADER -->
			<div id="global-loader">
				<img src="<?php echo e(URL::asset('assets/assets/images/loader.svg')); ?>" class="loader-img" alt="Loader">
			</div>
			<!-- /GLOABAL LOADER -->

			<!-- PAGE -->
			<div class="page">
				<div class="">
				    <!-- CONTAINER OPEN -->
					<div class="col col-login mx-auto">
						<div class="text-center">
							<!--<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo.png')); ?>" class="header-brand-img" alt="">-->
							<img src="<?php echo e(URL::asset('assets/assets/images/brand/logo1.png')); ?>" class="header-brand-img" alt="ORGANIZATION LOGO">
						</div>
					</div>
					<div class="container-login100">
						<div class="wrap-login100 p-0">
							<div class="card-body">
                                <form class="login100-form validate-form" method="POST" action="<?php echo e(route('login')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group" >
                                       <div class="input-group mb-4">
                                       
                    
                                        <input id="username" placeholder="Username" style="width:100%" type="text" class="input100 <?php if ($errors->has('username')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('username'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>"
                                            name="username" value="<?php echo e(old('username')); ?>" required autocomplete="username">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="zmdi zmdi-assignment-account" aria-hidden="true"></i>
                                            </span>
                                        <?php if ($errors->has('username')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('username'); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-4">
                                            <!--<div class="col" >-->
                                            <!--    <label for="password">Password</label>-->
                                            <!--</div>-->
                                            
                
                                            
                                        
                                        
                                       
                                        <input id="password" type="password" style="width:100%" placeholder="Password"
                                        class="input100 <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" required
                                            autocomplete="current-password">
                                            <span class="focus-input100"></span>
										<span class="symbol-input100">
											<i class="zmdi zmdi-lock" aria-hidden="true"></i>
										</span>
                
                                        <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                        <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                                    </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary account-btn" style="width:100%" type="submit"><font color="white">Login</font></button>
                                    </div>
                                    <div class="col-auto">                                
                                                <?php if(Route::has('password.request')): ?>
                                                    
													Not an administrator? <a class="text-primary" href="<?php echo e(route('tenant.login')); ?>">
                                                       Login as a Member
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                    
                                </form>
							</div>
							
						</div>
					</div>
					<!-- CONTAINER CLOSED -->
				</div>
			</div>
			<!-- End PAGE -->

		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- JQUERY JS -->
		<script src="<?php echo e(URL::asset('assets/assets/js/jquery.min.js')); ?>"></script>

		<!-- BOOTSTRAP JS -->
		<script src="<?php echo e(URL::asset('assets/assets/plugins/bootstrap/js/popper.min.js')); ?>"></script>
		<script src="<?php echo e(URL::asset('assets/assets/plugins/bootstrap/js/bootstrap.min.js')); ?>"></script>

		<!-- SPARKLINE JS -->
		<script src="<?php echo e(URL::asset('assets/assets/js/jquery.sparkline.min.js')); ?>"></script>

		<!-- CHART-CIRCLE JS -->
		<script src="<?php echo e(URL::asset('assets/assets/js/circle-progress.min.js')); ?>"></script>

		<!-- Perfect SCROLLBAR JS-->
		<script src="<?php echo e(URL::asset('assets/assets/plugins/p-scroll/perfect-scrollbar.js')); ?>"></script>

		<!-- INPUT MASK JS -->
		<script src="<?php echo e(URL::asset('assets/assets/plugins/input-mask/jquery.mask.min.js')); ?>"></script>

		<!-- CUSTOM JS-->
		<script src="<?php echo e(URL::asset('assets/assets/js/custom.js')); ?>"></script>

	</body>
</html>








<?php /**PATH C:\xampp\htdocs\membership\rms\resources\views/auth/login.blade.php ENDPATH**/ ?>