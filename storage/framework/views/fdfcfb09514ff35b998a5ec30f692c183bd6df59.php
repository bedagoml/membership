<?php $__env->startSection('css'); ?>
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

<?php $__env->startSection('content'); ?><br><br>
			<!-- ROW-1 -->
			<?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h6 class="">Registered Members</h6>
											<h3 class="mb-2 number-font"><?php echo e($tenants); ?></h3>
											
										</div>
										<div class="col col-auto">
											<div class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
												<i class="fa fa-users text-white mb-5 "></i>
											</div>
										</div>
										<div class="progress progress-sm mb-2 bg-primary-transparent">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 100%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h6 class="">Paid Invoices</h6>
											<h3 class="mb-2 number-font">Ksh.<?php echo e(number_format($paid_invoices)); ?></h3>
										</div>
										<div class="col col-auto">
											<div class="counter-icon bg-success-gradient box-shadow-danger brround  ms-auto">
												<i class="fe fe-check text-white mb-5 "></i>
											</div>
										</div>
										<div class="progress progress-sm mb-2 bg-success-transparent">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 100%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h6 class="">Unpaid Invoices</h6>
											<h3 class="mb-2 number-font">Ksh.<?php echo e(number_format($unpaid_invoices)); ?></h3>
										</div>
										<div class="col col-auto">
											<div class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
												<i class="fe fe-x text-white mb-5 "></i>
											</div>
										</div>
										<div class="progress progress-sm mb-2 bg-danger-transparent">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width: 100%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
						<!--Row-->
						<div class="row">
							<div class="col-xl-12 col-md-12 col-lg-12">
								

							<div class="col-xl-12 col-lg-6">
								<div class="row">
									<!--<div class="col-xl-3 col-md-12 col-lg-12">-->
									<!--	<div class="card">-->
									<!--		<div class="card-body">-->
									<!--			<div class="row">-->
									<!--				<div class="col">-->
									<!--					<p class="mb-1">Today's Collection</p>-->
									<!--					<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($income_today)); ?></h2>-->
									<!--				</div>-->
									<!--				<div class="col col-auto">-->
									<!--					<div id="spark1"></div>-->
									<!--				</div>-->
									<!--			</div>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--</div>-->
									<!--<div class="col-xl-3 col-md-12 col-lg-12">-->
									<!--	<div class="card">-->
									<!--		<div class="card-body">-->
									<!--			<div class="row">-->
									<!--				<div class="col">-->
									<!--					<p class="mb-1">This Month's Collection</p>-->
									<!--					<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($month_income)); ?></h2>-->
									<!--				</div>-->
									<!--				<div class="col col-auto">-->
									<!--					<div id="spark2"></div>-->
									<!--				</div>-->
									<!--			</div>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--</div>-->
									<!--<div class="col-xl-3 col-md-12 col-lg-12">-->
									<!--	<div class="card">-->
									<!--		<div class="card-body">-->
									<!--			<div class="row">-->
									<!--				<div class="col">-->
									<!--					<p class="mb-1">Today's Expenses</p>-->
									<!--					<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($bill_today)); ?></h2>-->
									<!--				</div>-->
									<!--				<div class="col col-auto">-->
									<!--					<div id="spark3"></div>-->
									<!--				</div>-->
									<!--			</div>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--</div>-->
									<!--<div class="col-xl-3 col-md-12 col-lg-12">-->
									<!--	<div class="card">-->
									<!--		<div class="card-body">-->
									<!--			<div class="row">-->
									<!--				<div class="col">-->
									<!--					<p class="mb-1">This Month's Expenses</p>-->
									<!--					<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($month_bill)); ?></h2>-->
									<!--				</div>-->
									<!--				<div class="col col-auto">-->
									<!--					<div id="spark3"></div>-->
									<!--				</div>-->
									<!--			</div>-->
									<!--		</div>-->
									<!--	</div>-->
									<!--</div>-->
								</div>
							</div>
						</div>

						<!--Row-->
						<div class="row row-deck">
								<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Members List</h3>
										<div class="card-options ">
											<!--<div class="btn-group ml-3 mb-0">-->
											<!--	<a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>-->
											<!--	<div class="dropdown-menu">-->
											<!--		<a class="dropdown-item" href="#">All Members</a>-->
											<!--		-->
													<!--<div class="dropdown-divider"></div>-->
											<!--		<a class="dropdown-item" href="#">Pay Invoices</a>-->
											<!--	</div>-->
											<!--</div>-->
										</div>
									</div>
									<div class="card-body overflow-hidden">
										<div class="h-400 scrollbar3" id="scrollbar3">
										    <div class="table-responsive">
                                <table class="table table-bordered  table-nowrap datatable" id="balance-table">
                                       <thead> <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $__empty_1 = true; $__currentLoopData = $tenats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $objects): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class=""><?php echo e(($objects->full_name)); ?></td>
                                            <td class="text-uppercase"><?php echo e(($objects->phone)); ?></td>
                                            
                                         


                                           

                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                         No Recent Tenant.

                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
										
										</div>
									</div>
								</div>
							</div>
							
							

							<div class="col-xl-8 col-lg-7 col-md-12">
								<div class="card card-block">
									<div class="card-header d-sm-flex d-block">
										<h3 class="card-title">Recent Invoice Payments</h3>
										<div class="ml-auto mt-4 mt-sm-0">
									
											<div class="btn-group ml-3 mb-0">
												<div class="dropdown-menu p-0">
												</div>
											</div>
										</div>
									</div>
									<div class="card-body">
										 <div class="table-responsive">
                               <table class="table table-striped custom-table mb-0" id="invoices-table">
                            <thead>
                                <tr>
                                    <th style="width:2%">#</th>
                                    <th style="width:37%">Member Name</th>
                                    <th style="width:37%">Member No.</th>
                                     <th style="width:15%">Amount</th>
                                    <th style="width:25%">Year</th>            
                                    <th style="width:5%">Status</th>  
                                  
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                            </div>
									</div>
								</div>
							</div>
						
																
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
    $(function () {
        $('#invoices-table').DataTable({
            processing: true,
            serverSide: true,
             "order": [[ 0, "desc" ]],
            ajax: '<?php echo route('api.invoice.paid'); ?>',
            columns: [ 
               // { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false , searchable:false},     
                     { data: 'id', name: 'id' },
                    //  { data: 'house.house_no', name: 'house.house_no', orderable: false },
                     { data: 'tenant.full_name', name: 'tenant.full_name',orderable: false },
                     { data: 'tenant.member_number', name: 'tenant.member_number' },
                      { data: 'paid_in', name: 'paid_in', orderable: false, searchable: false },
                     { data: 'subscription_year', name: 'subscription_year' },
                     { data: 'is_paid', name: 'is_paid' },  
					 
                    //  { data: 'bills', name: 'bills' },
                    //  { data: 'carryforward', name: 'carryforward', orderable: false, searchable: false },                     
                     //{ data: 'penalty_fee', name: 'penalty_fee', orderable: false, searchable: false },
                    //  { data: 'total_payable', name: 'total_payable', orderable: false, searchable: false },
                   
                    //  { data: 'balance', name: 'balance', orderable: false, searchable: false },
                        
                    //   { data: 'action', name: 'action',searchable:false,orderable:false },             
                     //{ data: 'download', name: 'download', searchable: false , orderable: false },                  
                    //{ data: 'delete', name: 'delete', searchable: false , orderable: false },                  
                             ]
        });
         $(document).on('submit','.delete-overpayment',function(event){
            return confirm('Are you sure you want to delete this Invoice ? The action cannot be reversed');            
        });
        
    });


</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rotary\rotary\resources\views/admins/index.blade.php ENDPATH**/ ?>