
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
							<!--<div class="page-leftheader">-->
							<!--	<h4 class="page-title">Advanced Foms</h4>-->
							<!--</div>-->
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<li class="breadcrumb-item"><a href="#">Reports</a></li>
									<li class="breadcrumb-item active" aria-current="page">Event Statement</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="row">
        
    </div>
    <!-- /Page Title -->

    <!-- Content Starts -->
    <div class="card">
        <form action="<?php echo e(route('event_statement')); ?>" method="get">
            <?php echo csrf_field(); ?>
            
            
            <div class="row">
               
    
                <div class="col-12">
                    <div class="">
                        <div class="card-body">
                            
    
                            
                            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <div class="row">
                                <div class="col-sm-12">
                                <label >Select Event<span class="text-danger">*</span></label>
                              
                                
                                <select class="form-control select2-show-search" style="width: 100%"  name="meeting_id" >
    
                                    <option selected disabled>-----Select-----</option>
                                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tenant=>$key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($key); ?>"><?php echo e($tenant); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    
                                        <?php endif; ?>
    
                                </select>
                                </div>
                            </div><br>
    
                            <div class="row mb-4">
                                <div class="col-sm-8">
                                    
                                   
                                    <button type="submit" class="btn btn-success waves-effect waves-light">Get Statement</button></button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </form>
        
        </div>
        <?php if($hasReport): ?>
 <div class="card" style="padding-top:25px; padding-bottom:25px; padding-left:25px; padding-right:25px;">
        <div class="row">
            <div class="col-12">
                <div class="title text-center">
                    <h2>EVENT STATEMENT</h2>
                </div>
            </div>
        </div>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                           
                           
                        </div> <!-- end col -->
                        <div class="col-xs-6  float-right" style="float:right;text-align:right;">
                            <div class="mt-3 float-right">
                                <img src="" alt="DEMO LOGO" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <!--<div class="title text-center">-->
                        <!--    <h4>Detailed Income Statement</h4>-->
                        <!--</div>-->
                    </div>
                   <div class="row table-responsive   ">
                        <table class="table dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 500px; width: 100%;">
                            <thead>
                              <tr>
                                   <tr style="padding-top:0px; padding-bottom:0px;">
                                    <th >Date</th>
                                    <th >Member Name</th>
                                    <th >Event Title</th>
                                    <th >Reference</th>
                                    <th >Event Price</th>
                                    <th >Event Amount Paid</th>
                               
                              </tr>
                                
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th ><?php echo e($entry['date']); ?></th>
                                    <th ><?php echo e($entry['tenant_name']); ?></th>
                                    <td ><?php echo e($entry['meeting_title']); ?></td>
                                    <td ><?php echo e($entry['reference']); ?></td>
                                    <td ><?php echo e($entry['amount']); ?></td>
                                    
                                   
    
                                    <?php if($entry['paid_in'] === '-'): ?>
                                    <td >
                                        <?php echo e($entry['paid_in']); ?>

                                    </td>
                                    <?php else: ?> 
                                    <td >
                                        <?php echo e(number_format($entry['paid_in'],2)); ?>

                                    </td>
                                    <?php endif; ?>
                                  </tr>
                              
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                    </div>
                    <div class="col-12">
                        <!--<div class="title text-center">-->
                        <!--    <h4>Summary</h4>-->
                        <!--</div>-->
                    </div>
                    <div class="row table-responsive   ">
                        <table class="table table-striped">
                            <thead>
                              <tr style="padding-top:0px; padding-bottom:0px;">
                                <td style="padding-top:0px; padding-bottom:0px;">Details</td>
                                <td style="padding-top:0px; padding-bottom:0px;" >Event Price</td>
                                <td style="padding-top:0px; padding-bottom:0px;" >Event Amount Paid</td>
                              </tr>
                            </thead>
                            <tbody style="padding-top:0px; padding-bottom:0px;">
                               
                                
                                
                               
                                <tr style="padding-top:0px; padding-bottom:0px;">
                                    <td style="padding-top:0px; padding-bottom:0px;">Total Event Price</td>
                                    <td style="padding-top:0px; padding-bottom:0px;"><?php echo e($rent_sum); ?></td>
                                    <td style="padding-top:0px; padding-bottom:0px;">-</td>
                                </tr>
                                <tr style="padding-top:0px; padding-bottom:0px;">
                                    <th style="padding-top:0px; padding-bottom:0px;">Total Income</th>
                                    <td style="padding-top:0px; padding-bottom:0px;">-</td>
                                    <th style="padding-top:0px; padding-bottom:0px;"><?php echo e($payments); ?></th>
                                </tr>
                                
                            </tbody>
                          </table>
                    </div>
                    <!-- end row -->
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <a  href="<?php echo e(\Request::fullUrl()); ?>&download=yes" target="_blank" class="m-2 btn btn-success waves-effect waves-light">Download Statement</a>
                            </div>
                    </div>

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>


    <!-- /Content End -->
         <?php endif; ?>
</div>

                    
           



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
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
    $('#apartment_id').change(function () {
        var id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "<?php echo route('ajax.houses.filter'); ?>",
            method: 'POST',
            data: { 'id': id, '_token': token },
            success: function (data) {
                $('#house-rent').val('');
                $('#section-bills').html('');
                $("select[name='house_id']").html('');
                $("select[name='house_id']").html(data.options);
            },
            error: function () {
                alert("error!!!!");
            }
        });
    });

    $('#houses_select').change(function () {
        var id = $(this).val();
        var token = $("input[name='_token']").val();

        $.ajax({
            url: "<?php echo route('ajax.house.bills'); ?>",
            method: 'POST',
            data: { 'id': id, '_token': token },
            success: function (data) {
                $('#house-rent').val('');
                $('#house-rent').val(data.house_rent);
            },
            error: function () {
                alert("error!!!!");
            }
        });

    });

    $(document).on('change', '#off-switch', function () {
        if ($(this).prop("checked") == true) {
            $("#new-tenant-row").prop('hidden', false);
            $("#checked-tenant").attr("name", "is_new_tenant");
        }
        else {
            $("#new-tenant-row").prop('hidden', true);
            $("#checked-tenant").removeAttr('name');
        }
    });

    $(function () {
        $('#datetimepicker10').datetimepicker({
            viewMode: 'years',
            format: 'MM/YYYY'
        });
    });

    $(document).on('focusout', '#tenant-id', function () {

        var id = $(this).val();
        var token = $("input[name='_token']").val();
        $.ajax({
            url: "<?php echo route('ajax.tenant.validate'); ?>",
            method: 'POST',
            data: { 'id': id, '_token': token },
            success: function (data) {

                if (data.exists) {
                    $('#tenant-names').removeClass('is-invalid');
                    $('#tenant-names').addClass('is-valid');
                    $('#tenant-names').val('');
                    $('#tenant-names').val(data.tenant_name);
                } else {
                     $('#tenant-names').removeClass('is-valid');
                     $('#tenant-names').addClass('is-invalid');
                    $('#tenant-names').val('');
                    $('#tenant-names').val(data.tenant_name);
                }

            },
            error: function () {
                alert("error!!!!");
            }
        });

    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/democlai/public_html/members/rms/resources/views/report/eventform.blade.php ENDPATH**/ ?>