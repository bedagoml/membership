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

        <!-- Select2 css -->
<link href="{{URL::asset('assets/plugins/select2/select2.min.css')}}" rel="stylesheet" />
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
							<img src="{{URL::asset('assets/assets/images/brand/logo1.png')}}" class="header-brand-img" alt="ORGANIZATION LOGO">
						</div>
					</div>
                    <div >
                        @include('includes.messages')
					<div class="container-login100 col-sm-12" style="align-text: center;">
                        
						<div class="wrap-login100 p-0" >
							<div class="card-body">
								<form action="{{ route('tenant_register.store')}}" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="col-sm-12" style="align: center;">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Full Names <span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" placeholder="Enter Full Names" class="form-control" name="full_name"
                                                        value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Degree <span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" placeholder="eg. Bsc Psychology" class="form-control" name="degree"
                                                        value="" required>
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-sm-12">
                                            <label >Year of Graduation <span class="text-danger">*</span></label>
                                           
                                            
                                            <select class="form-control select2-show-search" id='date-dropdown' style="width: 100%"  name="gradyear" >
                                                
                                               
                
                                            </select>
                                            
                                            </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>University<span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" placeholder="eg. University of Nairobi" class="form-control" name="university"
                                                        value="" required>
                                                       
        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Current Occupation<span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" placeholder="Enter your Occupation" class="form-control" name="occupation"
                                                        value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>County of Practice<span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control select2-show-search"  style="width: 100%"  name="county" >
                                                            <option value="baringo" selected>Baringo</option>
                                                            <option value="bomet">Bomet</option>
                                                            <option value="bungoma">Bungoma</option>
                                                            <option value="busia">Busia</option>
                                                            <option value="elgeyo marakwet">Elgeyo Marakwet</option>
                                                            <option value="embu">Embu</option>
                                                            <option value="garissa">Garissa</option>
                                                            <option value="homa bay">Homa Bay</option>
                                                            <option value="isiolo">Isiolo</option>
                                                            <option value="kajiado">Kajiado</option>
                                                            <option value="kakamega">Kakamega</option>
                                                            <option value="kericho">Kericho</option>
                                                            <option value="kiambu">Kiambu</option>
                                                            <option value="kilifi">Kilifi</option>
                                                            <option value="kirinyaga">Kirinyaga</option>
                                                            <option value="kisii">Kisii</option>
                                                            <option value="kisumu">Kisumu</option>
                                                            <option value="kitui">Kitui</option>
                                                            <option value="kwale">Kwale</option>
                                                            <option value="laikipia">Laikipia</option>
                                                            <option value="lamu">Lamu</option>
                                                            <option value="machakos">Machakos</option>
                                                            <option value="makueni">Makueni</option>
                                                            <option value="mandera">Mandera</option>
                                                            <option value="meru">Meru</option>
                                                            <option value="migori">Migori</option>
                                                            <option value="marsabit">Marsabit</option>
                                                            <option value="mombasa">Mombasa</option>
                                                            <option value="muranga">Muranga</option>
                                                            <option value="nairobi">Nairobi</option>
                                                            <option value="nakuru">Nakuru</option>
                                                            <option value="nandi">Nandi</option>
                                                            <option value="narok">Narok</option>
                                                            <option value="nyamira">Nyamira</option>
                                                            <option value="nyandarua">Nyandarua</option>
                                                            <option value="nyeri">Nyeri</option>
                                                            <option value="samburu">Samburu</option>
                                                            <option value="siaya">Siaya</option>
                                                            <option value="taita taveta">Taita Taveta</option>
                                                            <option value="tana river">Tana River</option>
                                                            <option value="tharaka nithi">Tharaka Nithi</option>
                                                            <option value="trans nzoia">Trans Nzoia</option>
                                                            <option value="turkana">Turkana</option>
                                                            <option value="uasin gishu">Uasin Gishu</option>
                                                            <option value="vihiga">Vihiga</option>
                                                            <option value="wajir">Wajir</option>
                                                            <option value="pokot">West Pokot</option>
                                               
                
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Address<span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" placeholder="Enter your address" class="form-control" name="address"
                                                        value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Telephone (Office)</label>
                                                <div>
                                                    <input type="text" class="form-control" placeholder="Enter office number" name="telephone" >
                                                       
        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Phone Number (eg. 254712...)<span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" class="form-control" placeholder="Enter Phone Number" name="phone" pattern=".{12,}"   required title="Phone number must begin with 254 and contain 12 characters"
                                                    maxlength="12">
                                                       
        
                                                </div>
                                            </div>
                                        </div>
        
                                        
                                       
                                    </div>
                                    <!-- end row -->
                                    <div class="col-sm-12" style="align-content: center;">
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>National ID/Passport Number<span class="text-danger">*</span> </label>
                                                <div>
                                                    <input type="text" class="form-control" placeholder="Enter National ID/Passport Number" name="id_number" value="" id="passport" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Email Address<span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="email" placeholder="Enter Email Address" class="form-control" name="email" 
                                                        value="" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Select your Membership category:<span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control select2-show-search"  style="width: 100%"  name="membership" >
                                                        <option disabled>-----Select-----</option>
                                                        @forelse ($subscription as $sub=>$key)
                                                            <option value="{{$sub}}">{{ $sub}}</option>
                                                            @empty
                    
                                                            @endforelse
                                                       
                                                       
                                                            
                                               
                
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Accreditation/License<span class="text-danger">*</span></label>
                                                <div>
                                                    <select class="form-control select2-show-search"  style="width: 100%"  name="license" >
                                                        <option value="0" selected>No</option>
                                                        <option value="1">Yes</option>
                                                           
                                                            
                                                            
                                               
                
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Member Number <span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" placeholder="Enter Member Number" class="form-control" name="member_number"  required id="member_number"
                                                        value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Set Password <span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="password" class="form-control" name="password"
                                                        value="{{old('password')}}" id="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Confirm Password <span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="password" class="form-control" name="repeat-password"
                                                        value="{{old('password')}}" id="password">
                                                </div>
                                            </div>
                                        </div>
                                        
        
                                        
                                        <div class="col-sm-12">
                                            <label>Subscription Date <span
                                                    class="text-danger">*</span></label>
                                            
                                                <div class="form-group">
                                                    <div class="cal-icon">
                                                        <input class="form-control " placeholder="Enter Date of Registration" type="date" name="member_date"
                                                            value="" required>
                                                    </div>
                                                </div>
                
                                            </div>
                                    </div><br><br>
                                    <div class="col-sm-12" style="align-content: center;">
                                            <strong><p>KPSYA SUBCOMMITTEES </p></strong><hr>
                                            <div class="col-sm-12">
                                                <label>Select one or more KPsyA Subcommittees<span
                                                        class="text-danger">*</span></label>
                                                
                                                    <div class="form-group">
                                                        <input type="checkbox" id="option-1" name="committees[]" value="Ethics Committee" required>
                                                        <label for="option-1"> Ethics Committee</label>&nbsp; &nbsp;
                                                        <input type="checkbox" id="option-2" name="committees[]" value="Membership Committee"required>
                                                        <label for="option-2"> Membership Committee</label>&nbsp; &nbsp;
                                                        <input type="checkbox" id="option-3" name="committees[]" value="Publications/Communications Committee" required>
                                                        <label for="option-3"> Publications/Communications Committee</label>&nbsp; &nbsp;
                                                            
                                                        
                                                    </div>
                    
                                                </div>
                                        </div><br>
                                       
                                    </div>
                                   
                                   
        
        
                                    <div class="col-sm-12" style="align-content: center;">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">
                                                        Submit
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">                                
										@if (Route::has('password.request'))
											{{-- <a class="text-primary" href="{{ route('password.request') }}">
												Forgot password ? 
											</a>  --}}
											Already have an account? <a class="text-primary" href="{{ route('tenant.login') }}">
												Login
											</a>
										@endif
									</div><br>
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
					</div>
					<!-- CONTAINER CLOSED -->
				</div>
			</div>
			<!-- End PAGE -->

		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->

		<!-- JQUERY JS -->
        <script>
            let dateDropdown = document.getElementById('date-dropdown');
          
            let currentYear = new Date().getFullYear();
            let earliestYear = 1930;
          
            while (currentYear >= earliestYear) {
              let dateOption = document.createElement('option');
              dateOption.text = currentYear;
              dateOption.value = currentYear;
              dateDropdown.add(dateOption);
              currentYear -= 1;
            }
          </script>
		<script src="{{URL::asset('assets/assets/js/jquery.min.js')}}"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{URL::asset('assets/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
		<script src="{{URL::asset('assets/assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <!--Select2 js -->
<script src="{{URL::asset('assets/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>

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


