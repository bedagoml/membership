<?php $__env->startSection('css'); ?>
<!-- Select2 css -->
<link href="<?php echo e(URL::asset('assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<!-- File Uploads css -->
<link href="<?php echo e(URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')); ?>" rel="stylesheet" />
<!-- Time picker css -->
<link href="<?php echo e(URL::asset('assets/plugins/time-picker/jquery.timepicker.css')); ?>" rel="stylesheet" />
<!-- Date Picker css -->
<link href="<?php echo e(URL::asset('assets/plugins/date-picker/date-picker.css')); ?>" rel="stylesheet" />
<!-- File Uploads css-->
 <link href="<?php echo e(URL::asset('assets/plugins/fileupload/css/fileupload.css')); ?>" rel="stylesheet" type="text/css" />
<!--Mutipleselect css-->
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/plugins/multipleselect/multiple-select.css')); ?>">
<!--Sumoselect css-->
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/plugins/sumoselect/sumoselect.css')); ?>">
<!--intlTelInput css-->
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/plugins/intl-tel-input-master/intlTelInput.css')); ?>">
<!--Jquerytransfer css-->
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/plugins/jQuerytransfer/jquery.transfer.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/plugins/jQuerytransfer/icon_font/icon_font.css')); ?>">
<!--multi css-->
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/plugins/multi/multi.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
 <!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title"></h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Member</li>
								</ol>
							</div>
						</div>
						<!-- PAGE-HEADER END -->
						
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Title -->
    
    <!-- /Page Title -->

    <!-- Content Starts -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    
                   
                    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="p-20 pt-2">
                        <form action="<?php echo e(route('tenant.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Full Names <span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" placeholder="Enter Full Names" class="form-control" name="full_name"
                                                value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Degree <span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" placeholder="eg. Bsc Psychology" class="form-control" name="degree"
                                                value="" required>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-sm-4">
                                    <label >Year of Graduation <span class="text-danger">*</span></label>
                                   
                                    
                                    <select class="form-control select2-show-search" id='date-dropdown' style="width: 100%"  name="gradyear" >
                                        
                                       
        
                                    </select>
                                    
                                    </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>University<span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" placeholder="eg. University of Nairobi" class="form-control" name="university"
                                                value="" required>
                                               

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Current Occupation<span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" placeholder="Enter your Occupation" class="form-control" name="occupation"
                                                value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Address<span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" placeholder="Enter your address" class="form-control" name="address"
                                                value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Telephone (Office)</label>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Enter office number" name="telephone" >
                                               

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
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
                            <div class="row">
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>National ID/Passport Number<span class="text-danger">*</span> </label>
                                        <div>
                                            <input type="text" class="form-control" placeholder="Enter National ID/Passport Number" name="id_number" value="" id="passport" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Email Address<span class="text-danger">*</span></label>
                                        <div>
                                            <input type="email" placeholder="Enter Email Address" class="form-control" name="email" 
                                                value="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Select your Membership category:<span class="text-danger">*</span></label>
                                        <div>
                                            <select class="form-control select2-show-search"  style="width: 100%"  name="membership" >
                                                <option disabled>-----Select-----</option>
                                                <?php $__empty_1 = true; $__currentLoopData = $subscription; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <option value="<?php echo e($sub); ?>"><?php echo e($sub); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
                                                    <?php endif; ?>
                                               
                                               
                                                    
                                       
        
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Member Number <span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" placeholder="Enter Member Number" class="form-control" name="member_number"  required id="member_number"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                

                                
                                <div class="col-sm-4">
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
                            <div class="row">
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
                           
                            <div class="row">
                            </div>


                            <div class="row">
                                <div class="col-sm-4">
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
                        </form>
                       

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- /Content End -->

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


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

<script>
$('button[type="submit"]').on('click', function() {
    $cbx_group = $("input:checkbox[name='committees[]']");
    $cbx_group = $("input:checkbox[id^='option-']"); // name is not always helpful ;)

    $cbx_group.prop('required', true);
    if($cbx_group.is(":checked")){
    $cbx_group.prop('required', false);
}
});
</script>
<!--Select2 js -->
<script src="<?php echo e(URL::asset('assets/plugins/select2/select2.full.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/select2.js')); ?>"></script>
<!-- Timepicker js -->
<script src="<?php echo e(URL::asset('assets/plugins/time-picker/jquery.timepicker.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/time-picker/toggles.min.js')); ?>"></script>
<!-- Datepicker js -->
<script src="<?php echo e(URL::asset('assets/plugins/date-picker/date-picker.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/date-picker/jquery-ui.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/input-mask/jquery.maskedinput.js')); ?>"></script>
<!--File-Uploads Js-->
<script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')); ?>"></script>
<!-- File uploads js -->
<script src="<?php echo e(URL::asset('assets/plugins/fileupload/js/dropify.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/filupload.js')); ?>"></script>
<!-- Multiple select js -->
<script src="<?php echo e(URL::asset('assets/plugins/multipleselect/multiple-select.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/multipleselect/multi-select.js')); ?>"></script>
<!--Sumoselect js-->
<script src="<?php echo e(URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')); ?>"></script>
<!--intlTelInput js-->
<script src="<?php echo e(URL::asset('assets/plugins/intl-tel-input-master/intlTelInput.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/intl-tel-input-master/country-select.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/intl-tel-input-master/utils.js')); ?>"></script>
<!--jquery transfer js-->
<script src="<?php echo e(URL::asset('assets/plugins/jQuerytransfer/jquery.transfer.js')); ?>"></script>
<!--multi js-->
<script src="<?php echo e(URL::asset('assets/plugins/multi/multi.min.js')); ?>"></script>
<!-- Form Advanced Element -->
<script src="<?php echo e(URL::asset('assets/js/formelementadvnced.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/form-elements.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/file-upload.js')); ?>"></script>
  <script>
   $('document').ready(function(){
 var username_state = false;
 var email_state = false;
 $('#username').on('blur', function(){
  var username = $('#username').val();
  if (username == '') {
  	username_state = false;
  	return;
  }
  $.ajax({
    url: 'register.php',
    type: 'post',
    data: {
    	'username_check' : 1,
    	'username' : username,
    },
    success: function(response){
      if (response == 'taken' ) {
      	username_state = false;
      	$('#username').parent().removeClass();
      	$('#username').parent().addClass("form_error");
      	$('#username').siblings("span").text('Sorry... Username already taken');
      }else if (response == 'not_taken') {
      	username_state = true;
      	$('#username').parent().removeClass();
      	$('#username').parent().addClass("form_success");
      	$('#username').siblings("span").text('Username available');
      }
    }
  });
 });		
  $('#email').on('blur', function(){
 	var email = $('#email').val();
 	if (email == '') {
 		email_state = false;
 		return;
 	}
 	$.ajax({
      url: 'register.php',
      type: 'post',
      data: {
      	'email_check' : 1,
      	'email' : email,
      },
      success: function(response){
      	if (response == 'taken' ) {
          email_state = false;
          $('#email').parent().removeClass();
          $('#email').parent().addClass("form_error");
          $('#email').siblings("span").text('Sorry... Email already taken');
      	}else if (response == 'not_taken') {
      	  email_state = true;
      	  $('#email').parent().removeClass();
      	  $('#email').parent().addClass("form_success");
      	  $('#email').siblings("span").text('Email available');
      	}
      }
 	});
 });

 $('#reg_btn').on('click', function(){
 	var username = $('#username').val();
 	var email = $('#email').val();
 	var password = $('#password').val();
 	if (username_state == false || email_state == false) {
	  $('#error_msg').text('Fix the errors in the form first');
	}else{
      // proceed with form submission
      $.ajax({
      	url: 'register.php',
      	type: 'post',
      	data: {
      		'save' : 1,
      		'email' : email,
      		'username' : username,
      		'password' : password,
      	},
      	success: function(response){
      		alert('user saved');
      		$('#username').val('');
      		$('#email').val('');
      		$('#password').val('');
      	}
      });
 	}
 });
});
    </script>  
    
    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\membership\rms\resources\views/members/register.blade.php ENDPATH**/ ?>