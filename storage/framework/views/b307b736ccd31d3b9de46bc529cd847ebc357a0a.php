
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
						<!--Page header-->
						<div class="page-header">
						
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">Edit Property</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    

    <!-- end row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    
                    <div class="col-6">
                        <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="p-20">
                        <form action="<?php echo e(route('apartment.update',$apartment->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                              <div class="row">
                                <div class="col-sm-6">
                                    <label >Property
                                        <span class="text-danger"> *</span></label>
                                    
                                        <input class="form-control" type="text" id="example-text-input" name="name"
                                            value="<?php echo e($apartment->name); ?>">
                                    
                                </div>
                                <div class="col-sm-6">
                                    <label >Town
                                        Located: <span class="text-danger"> *</span></label>
                                    
                                        <input class="form-control" type="text" id="example-text-input" name="town"
                                            placeholder="E.g Matasia" value="<?php echo e($apartment->town); ?>">
                                 
                                </div>
                            </div><br>
                               
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Number of Houses <span class="text-muted test-small"></span></label>
                                        <div class="input-group ">
                                            <input type="text" class="form-control"  name="houses_qty"
                                            value="<?php echo e($apartment->houses_qty); ?>">
                                        
                                        </div>
                                        
                                
                                </div>
                                <div class="col-sm-6">
                                    <label>Agency Fee
                                        Percentage <span class="text-muted test-small"></span></label>
                                        <div class="input-group ">
                                            <input type="text" class="form-control" aria-label="Management fee"
                                            aria-describedby="basic-addon2" name="management_fee"
                                            value="<?php echo e($apartment->management_fee_percentage); ?>">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">%</span>
                                        </div>
                                        </div>
                                        
                                
                                </div>
                                

                        </div><br>
                         <div class="row">
                                    <div class="col-sm-12">
                                        <label>Property
                                            Description <span class="text-muted test-small"></span></label>
                                        
                                            <input class="form-control" type="text" id="example-text-input" name="description"
                                                value="<?php echo e($apartment->description); ?>">
                                    
                                    </div>
                                 

                            </div><br>
                            

                            <div class="row">
                                <div >
                                    <button type="submit" class="btn btn-success waves-effect waves-light mr-3">Update
                                        Details</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/lesaagen/rmslesa/rms/resources/views/apartments/edit.blade.php ENDPATH**/ ?>