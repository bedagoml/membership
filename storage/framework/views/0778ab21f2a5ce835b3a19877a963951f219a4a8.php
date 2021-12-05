<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Rotary Member Invoice | Download</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link href=" <?php echo e(asset('assets/css/invoice_style.css')); ?> " rel="stylesheet" type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card-box">
                                <!-- Logo & title -->
                                <div class="clearfix">
                                    <div class="float-left">
                                         <img src="" alt="Rotary Logo" height="100">
                                    </div>
                                    <div class="float-right">
                                        
                                    </div>
                                </div>

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
                              
                                    <td class="d-none d-sm-table-cell"> Amount </td>
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
                                    			
												
											</table>
										</div>
										<h5>Other information</h5>
                            <p class="text-muted"><br>
                                The invoiced member has a balance of <strong>Ksh <?php echo e(number_format($invoice->balance )); ?></strong> on this invoice<br />
                                </p>
									</div>
								</div>
							</div>
						</div>
						<!-- End row-->

					</div>
				</div><!-- end app-content-->
			</div>    <!-- END wrapper -->
</body>

</html><?php /**PATH C:\xampp\htdocs\rent\rms\resources\views/invoices/invoicepf.blade.php ENDPATH**/ ?>