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
<style>
    /* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
						<!--Page header-->
						<div class="page-header">
							<!--<div class="page-leftheader">-->
							<!--	<h4 class="page-title">Advanced Foms</h4>-->
							<!--</div>-->
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">Create Bill</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
						<!-- Row -->
						<div class="row">
							<div class="col-lg-12 col-md-12">
                                <div class="tab">
                                    <button class="tablinks"  style="border-radius: 20px;" onclick="openCity(event, 'Project')">Project Bill</button>
                                    <button class="tablinks" style="border-radius: 20px;"  onclick="openCity(event, 'Administration')">Administration Bill</button>
                                  </div><br>
                                  <div id="Project" class="tabcontent">
                                  <form action="<?php echo e(route('bill.store')); ?>" method="post" class="card" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                   
                                      
                                        <div class="row">
                                            <?php echo e(csrf_field()); ?>

                                
                                            <div class="col-12">
                                                <div class="">
                                                    <div class="card-body">
                                                        
                                
                                                        
                                                        <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                       
                                                         <div class="row">
                                                            <div class="col-md-6" >
                                                                <label>Amount Source<span class="text-danger">*</span></label>
                                                                <input class="form-control " type="hidden" name="bill_type" value="Project" readonly>
                                                                <select  class="form-control select2-show-search" style="width: 100%" name="bill_source">
                                
                                                                    <option selected disabled>-----Select-----</option>
                                                                 
                                                                  
                                                                <option value="Happy Hundreds">Happy Hundreds</option>
                                                                <option value="Other">Other</option>
                                                           
                                                                </select>
                                                               
                                                            </div>
                                                            <div class="col-sm-6" >
                                                                <div class="form-group">
                                                                    <label>Bill Title<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="form-group">
                                                                               
                                
                                                                        <select  class="form-control select2-show-search" style="width: 100%" name="bill_title">
                                
                                                                            <option selected disabled>-----Select-----</option>
                                                                          <?php $__empty_1 = true; $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                                          <?php if($pay): ?>
                                                                          
                                                                        <option value="<?php echo e($pay->project_title); ?>"><?php echo e($pay->project_title); ?></option>
                                                                       <?php endif; ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                             
                                                                                <?php endif; ?>
                                             
                                                                        </select>
                                                                           
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div><br>
                                                             
                                                             
                                                            
                                                            <div class="row">
                                                           
                                                            
                                                               
                                                             
                                                                <div class="col-sm-6 ">
                                                                    <div class="form-group">
                                                                        <label> Bill Raised By</label>
                                                                        <div>
                                                                            
                                                                            
                                                                            <input class="form-control " type="text" id="example-text-input" name="agency_user"
                                                                        value="<?php echo e(Auth::user()->name); ?>" readonly>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label>Amount<span class="text-danger">*</span></label>
                                                                            <div>
                                                                                <div class="form-group">
                                                                                   
                                                                                        <input class="form-control " type="text" id="example-text-input" name="bill_amount"
                                                                                value="">
                                                                                   
                                                                                </div>
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                
                                                                
                                                                
                                                                
                                                                
                                                            </div>
                                                            
                                                            
                                                            
                                                    
                                                           
                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <label>Bill Description <span class="text-danger">*</span></label>
                                                                                    <textarea name="bill_description" class="form-control" rows="6"  ></textarea>
                                                                                        
                                                                                    </div>
                                                                        </div><br>
                                                                                
                                                                        <?php if(Auth::user()->is_admin == 2 ): ?>
                                                                        <input class="form-control" type="text" readonly name="approval"
                                                                        value="1" hidden>
                                                                     
                                                                        <?php else: ?>
                                                                        <input class="form-control" type="text" readonly name="approval"
                                                                        value="0" hidden>
                                                                        
                                                                        <?php endif; ?>                
                                                                        
                                                      
                                                         
                                                                
                                
                                                        <div class="row mb-4">
                                                            <div class="col-sm-8">
                                                                
                                                               
                                                                <button type="submit" class="btn btn-success waves-effect waves-light">Add Bill</button></button>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>            
                                        </div>
                                    </div>
                                    
                                    
                                    
                                </form>
                                <div id="Administration" class="tabcontent">
								<form action="<?php echo e(route('bill.store')); ?>" method="post" class="card" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
       
       
            <div class="row">
                <?php echo e(csrf_field()); ?>

    
                <div class="col-12">
                    <div class="">
                        <div class="card-body">
                            
    
                            
                            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                           
                             <div class="row">
                                <div class="col-md-6">
                                    <label>Amount Source<span class="text-danger">*</span></label>
                                    <input class="form-control " type="hidden" name="bill_type" value="Administration" readonly>
                                    <select  class="form-control select2-show-search" style="width: 100%" name="bill_sources">
    
                                        <option selected disabled>-----Select-----</option>
                                     
                                      
                                    <option value="Happy Hundreds">Happy Hundreds</option>
                                    <option value="Other">Other</option>
                               
                                    </select>
                                   
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Bill Title<span class="text-danger">*</span></label>
                                        <div>
                                            <div class="form-group">
                                                    <input  class="form-control " type="text" id="example-text-input" name="bill_titles"
                                            value="">
    
                                               
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                               
                            </div><br>
                                 
                                 
                                
                                <div class="row">
                               
                                
                                   
                                 
                                    <div class="col-sm-6 conditionalSections">
                                        <div class="form-group">
                                            <label> Bill Raised By</label>
                                            <div>
                                                
                                                
                                                <input class="form-control " type="text" id="example-text-input" name="agency_users"
                                            value="<?php echo e(Auth::user()->name); ?>" readonly>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Amount<span class="text-danger">*</span></label>
                                                <div>
                                                    <div class="form-group">
                                                       
                                                            <input class="form-control " type="text" id="example-text-input" name="bill_amounts"
                                                    value="">
                                                       
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    
                                    
                                    
                                    
                                    
                                </div>
                                
                                
                                
                        
                               
                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <label>Bill Description <span class="text-danger">*</span></label>
                                                        <textarea name="bill_descriptions" class="form-control" rows="6"  ></textarea>
                                                            
                                                        </div>
                                            </div><br>
                                                    
                                            <?php if(Auth::user()->is_admin == 2 ): ?>
                                            <input class="form-control" type="text" readonly name="approval"
                                            value="1" hidden>
                                         
                                            <?php else: ?>
                                            <input class="form-control" type="text" readonly name="approval"
                                            value="0" hidden>
                                            
                                            <?php endif; ?>                
                                            
                          
                             
                                    
    
                            <div class="row mb-4">
                                <div class="col-sm-8">
                                    
                                   
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Add Bill</button></button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        
        
        
    </form>

								
							</div>
						
					</div>
			
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rotary\rotary\resources\views/bills/create.blade.php ENDPATH**/ ?>