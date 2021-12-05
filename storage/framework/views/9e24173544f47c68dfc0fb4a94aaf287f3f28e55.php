<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?><br><br>
			<!-- ROW-1 -->
			<?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
					<div class="row">
						<div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
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
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width: 10%"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12 col-sm-12 col-xl-6">
							<div class="card overflow-hidden">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h6 class="">Current Subscription Fee</h6>
											<h3 class="mb-2 number-font">Ksh.<?php echo e(number_format($subscription->amount)); ?></h3>
										</div>
										<div class="col col-auto">
											<div class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
												<i class="fe fe-dollar-sign text-white mb-5 "></i>
											</div>
										</div>
										<div class="progress progress-sm mb-2 bg-orange-transparent">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-orange" style="width: 100%"></div>
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
									<div class="col-xl-3 col-md-12 col-lg-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<p class="mb-1">Today's Collection</p>
														<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($income_today)); ?></h2>
													</div>
													<div class="col col-auto">
														<div id="spark1"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-md-12 col-lg-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<p class="mb-1">This Month's Collection</p>
														<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($month_income)); ?></h2>
													</div>
													<div class="col col-auto">
														<div id="spark2"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-md-12 col-lg-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<p class="mb-1">Today's Expenses</p>
														<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($bill_today)); ?></h2>
													</div>
													<div class="col col-auto">
														<div id="spark3"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-md-12 col-lg-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<p class="mb-1">This Month's Expenses</p>
														<h2 class="mb-0 font-weight-bold">Ksh.<?php echo e(number_format($month_bill)); ?></h2>
													</div>
													<div class="col col-auto">
														<div id="spark3"></div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!--Row-->
						<div class="row row-deck">
								<div class="col-xl-4 col-lg-4 col-md-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Recent Members</h3>
										<div class="card-options ">
											<div class="btn-group ml-3 mb-0">
												<a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu">
													<a class="dropdown-item" href="#">All Members</a>
													
													<!--<div class="dropdown-divider"></div>-->
													<a class="dropdown-item" href="#">Pay Invoices</a>
												</div>
											</div>
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
										<h3 class="card-title">Recent Subscribers (Fully Paid)</h3>
										<div class="ml-auto mt-4 mt-sm-0">
											<!--<a class="btn btn-white" href="#">Week</a>-->
											<!--<a class="btn btn-white" href="#">Month</a>-->
											<!--<a class="btn btn-primary" href="#">Year</a>-->
											<div class="btn-group ml-3 mb-0">
												<!--<a href="#" class="option-dots" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>-->
												<div class="dropdown-menu p-0">
													<!--<a class="dropdown-item" href="#"><i class="fa fa-download"></i> Download</a>-->
													<!--<a class="dropdown-item" href="#"><i class="fa fa-cog mr-2"></i> Settings</a>-->
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
                                    <!--<th style="width:13%">House</th>-->
                                    <th style="width:37%">Member Name</th>
                                    <th style="width:25%">Subscription Year</th>
                                    <th>Invoiced Month</th>
                                    
                                    
                                    <!--<th style="width:10%">Total Payable</th>                                    -->
                                    <th style="width:15%">Paid</th>                                    
                                    <!--<th style="width:10%">Balance</th>                                    -->
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
							<div>
								<form action="<?php echo e(route('subscription.update',$subscription->id)); ?>" method="POST" enctype="multipart/form-data">
									<?php echo csrf_field(); ?>
									<?php echo method_field('PUT'); ?>
									
									<div class="row">
										<div class="col-12">
											<div class="card">
												<div class="card-body">
													<div class="row">
														<div class="col-sm-6">
														<label >Subscription Fee <span class="text-danger">*</span></label>
														<input type="text" class="form-control" name="amount" value="<?php echo e($subscription->amount); ?>" >
													</div>
														</div><br>
												   
										   
												   
												   
					
					
													<button class="btn btn-success" type="submit">  Define
														Fee</button>
					
												</div>
											</div>
										</div>
									</div>
								</div>
																
							</div>
					
								</form>
							</div>
							
						
							
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

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
                     { data: 'subscription_year', name: 'subscription_year' },
					 { data: 'rent_month', name: 'rent_month' },
                    //  { data: 'bills', name: 'bills' },
                    //  { data: 'carryforward', name: 'carryforward', orderable: false, searchable: false },                     
                     //{ data: 'penalty_fee', name: 'penalty_fee', orderable: false, searchable: false },
                    //  { data: 'total_payable', name: 'total_payable', orderable: false, searchable: false },
                    { data: 'paid_in', name: 'paid_in', orderable: false, searchable: false },
                    //  { data: 'balance', name: 'balance', orderable: false, searchable: false },
                     { data: 'is_paid', name: 'is_paid' },     
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


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rent\rms\resources\views/admins/index.blade.php ENDPATH**/ ?>