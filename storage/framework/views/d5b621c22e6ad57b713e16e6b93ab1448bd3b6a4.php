<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
						<!--Page header-->
						<div class="page-header">
							<!--<div class="page-leftheader">-->
							<!--	<h4 class="page-title">Invoice</h4>-->
							<!--</div>-->
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="d-flex"><svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg><span class="breadcrumb-icon"> Home</span></a></li>
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">Invoices</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
						<!-- Row-->
						<div class="row">
							<div class="col-md-12">
							    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<div class="card overflow-hidden">
									<div class="card-status bg-primary"></div>
									<div class="card-body">
										<h2 class="text-muted font-weight-bold">INVOICE</h2>
										<!--<div class="">-->
										<!--	<h5 class="mb-1">Hi <strong>Jessica Allen</strong>,</h5>-->
										<!--	This is the receipt for a payment of <strong>$450.00</strong> (USD) for your works-->
										<!--</div>-->

										<div class="card-body pl-0 pr-0">
											<div class="row">
												<div class="col-sm-6">
													<span>Invoice No.</span><br>
													<strong>INV #<?php echo e($invoice->id); ?></strong>
												</div>
												<div class="col-sm-6 text-right">
													<span>Generated Date</span><br>
													<strong><?php echo e($invoice->created_at); ?></strong>
												</div>
											</div>
										</div>
										<div class="dropdown-divider"></div>
										<div class="row pt-4">
											<div class="col-lg-6 ">
												<p class="h5 font-weight-bold">Billing Details</p>
												<address>
                              
                             
                                Status:
                                    <?php if($invoice->is_paid===1): ?>
                                    <span class="text-success font-weight-bold"> PAID </span>
                                    <?php elseif($invoice->is_paid===0 && $invoice->paid_in > 0 ): ?>
                                    <span class="text-warning font-weight-bold"> PARTIAL PAYMENT</span>
                                    <?php else: ?>
                                    <span class="text-danger font-weight-bold"> UNPAID </span>
                                    <?php endif; ?>

												</address>
											</div>
											<div class="col-lg-6 text-right">
												<p class="h5 font-weight-bold">Invoice To</p>
												 <address>
                                        Name: <?php if($invoice->tenant_id > 0): ?>
                                              <?php echo e($invoice->tenant->full_name); ?>

                                              <?php else: ?>
                                              <?php echo e($invoice->tenant_name); ?>

                                              <?php endif; ?> <br>
                                             
                                      
                                       
                                        Phone Number: <?php if($invoice->tenant_id > 0): ?>
                                              +<?php echo e($invoice->tenant->phone); ?>

                                              <?php elseif($invoice->tenant_phone > 0): ?>
                                              +<?php echo e($invoice->tenant_phone); ?>

                                              <?php else: ?>
                                              <span class="text-danger "> NO PHONE </span>
                                              <?php endif; ?><br>
                                        Account Number: <?php if($invoice->tenant_id > 0): ?>
                                              <?php echo e($invoice->tenant->account_number); ?>

                                              <?php else: ?>
                                             <span class="text-danger "> NO ACCOUNT NUMBER </span>
                                              <?php endif; ?><br>
                                        
                                    </address>
											</div>
										</div>
										<div class="table-responsive push">
											<table class="table table-bordered table-hover text-nowrap">
											    
												<tr>
                                   
                                    <th class="d-none d-sm-table-cell">DESCRIPTION</th>
                                    <th class="text-right">TOTAL</th>
                                </tr>
                                <?php if($invoice->type == 'annual_subscription' || $invoice->type == 'First Annual Subscription' || $invoice->type == null): ?>
                                <?php if($invoice->amount > 0): ?>
                                <tr>
                              
                                    <td class="d-none d-sm-table-cell"> Subscription Amount - <?php echo e($invoice->description); ?> </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->amount)); ?></td>
                                </tr>
                                <?php endif; ?>
                               
                                <?php if($invoice->carryforward > 0): ?>
                                <tr>
                                
                                   
                                    <td class="d-none d-sm-table-cell"> Arrears </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                <?php endif; ?>
                               
                                
                                <?php else: ?>
                                <tr>
                                   
                                     <?php if($invoice->type === 'donation'): ?>
                                    <td class="d-none d-sm-table-cell">Donation Amount</td>
                                    <?php elseif($invoice->type === 'foundation'): ?>
                                    <td class="d-none d-sm-table-cell">Foundation Fee</td>
                                     <?php else: ?>
                                     <td class="d-none d-sm-table-cell">Others - <?php echo e($invoice->description); ?></td>
                                      <?php endif; ?>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->total_payable)); ?></td>
                                </tr>
                                 <?php endif; ?>
                                

                                <?php
                                $count=3;
                                ?>

                               
												
												
											
											
                                
                                                <tr>
                                                   	<td colspan="1" class="font-weight-bold text-uppercase text-right h5 mb-0">Sub Total</td>
                                                    <td class="text-right">Ksh
                                                        <?php echo e(number_format($invoice->total_payable )); ?>

                                                    </td>
                                                </tr>
                                                <tr>
                                                   	<td colspan="1" class="font-weight-bold text-uppercase text-right h5 mb-0">Total Paid</td>
                                                    <td class="text-right text-success text-bold">Ksh
                                                        <?php echo e(number_format($invoice->paid_in )); ?>

                                                    </td>
                                                </tr>
                                                
                                                    
                                                <!--    <tr>-->
                                                <!--    <th>To pay:</th>-->
                                                <!--    <td class="text-right">Ksh <?php echo e(number_format($invoice->total_payable- $invoice->paid_in )); ?> -->
                                                <!--    </td>-->
                                                <!--</tr>-->
                                                
                                             <tr>
													<td colspan="1" class="font-weight-bold text-uppercase text-right h5 mb-0">Total Due</td>
													<td class="text-right text-danger text-bold">Ksh <?php echo e(number_format($invoice->balance)); ?></td>
												</tr>
                                    			
												<tr>
												    
													<td colspan="5" class="text-right">
													
														
														<!--<button type="button" class="btn btn-primary" onClick="javascript:window.print();"><i class="si si-wallet"></i> Pay Invoice</button>-->
														
														<a href="<?php echo e(route('invoice.show',[$invoice->id,'action'=>'pdf'])); ?>" target="_blank"><button type="button" class="btn btn-success" ><i class="fa fa-download"></i> Download PDF</button></a>
														<button type="button" class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
													</td>
												</tr>
											</table>
										</div>
										<h5>Other information</h5>
                            <p class="text-muted"><br>
                                The invoiced member has a balance of <strong>Ksh <?php echo e(number_format($invoice->balance )); ?></strong> on this invoice <br />
                                </p>
									</div>
								</div>
							</div>
						</div>
						<!-- End row-->

					</div>
				</div><!-- end app-content-->
			</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('header_scripts'); ?>
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datetimepicker.min.css')); ?>">

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header mb-4 d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Invoice</h3>
            </div>
            <div class="col-auto float-right ml-auto">
                <div class="btn-group">
                    
                    &nbsp;
                    <a href="<?php echo e(route('invoice.show',[$invoice->id,'action'=>'print'])); ?>" target="_blank" class="btn btn-white" id="btn-invoice"><i class="fa fa-print fa-lg"></i>Print Invoice</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row myinvoice">
        <div class="col-md-12">
            <div class="card px-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 m-b-20">
                            <!--<img src="" class="inv-logo" alt="Your Logo Here">-->
                            <h3>Member Details</h3>
                                   
                            <div class="row mt-3">
                                <div class="col-sm-4">
                                    
                                </div> <!-- end col -->

                               <!-- end col -->
                            </div>
                        </div>
                        <div class="col-sm-6 m-b-20">
                            <div class="invoice-details">
                                <h3 class="text-uppercase text-blue">Invoice #-</h3>
                                <ul class="list-unstyled">
                                    <li>Generated On: <span class="text-info "></span></li>
                                    <!--<li>Due date: <span>5th <?php echo e(\Carbon\Carbon::createFromFormat('M-Y',$invoice->rent_month)->format('M-Y')); ?></span></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
                          
                        </div>
                        <div class="col-sm-6 col-lg-5 col-xl-4 m-b-20">
                            <span class="text-muted">Billing Details:</span>
                            <ul class="list-unstyled invoice-payment-details">
                                <li>
                                    <h5>Total Due: <span class="text-right font-weight-bold">Ksh
                                            <?php echo e(number_format($invoice->balance + $invoice->penalty_fee)); ?></span>
                                    </h5>
                                </li>
            
                                


                            </ul>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                               
                                <tr>
                                    <th>#</th>
                                    <th class="d-none d-sm-table-cell">DESCRIPTION</th>
                                    <th class="text-right">TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div> 
                    <br/>
                    
                    
                    <div>
                        <div class="row invoice-payment">
                            <div class="col-sm-7">
                            </div>
                           
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\membership\rms\resources\views/invoices/invoice.blade.php ENDPATH**/ ?>