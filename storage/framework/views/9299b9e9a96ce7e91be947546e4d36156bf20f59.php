<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>LIA Invoices</title>
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
                                         <img src="<?php echo e(asset('assets/img/lesa.png')); ?>" alt="Lesa Logo" height="100">
                                    </div>
                                    <div class="float-right">
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                      

                                    </div><!-- end col -->
                                    <div class="col-xs-4 offset-xs-2 float-right" style="float:right;text-align:right;">
                                        <div class="mt-3 float-right">
                                            <p class="m-b-10"><strong>Generated On : </strong> <span
                                                    class="float-right">
                                                    <?php echo e($invoice->created_at); ?></span></p>
                                            <!--<p class="m-b-10"><strong>Invoice Due Date : </strong> <span-->
                                            <!--        class="float-right" style="color: red;">-->
                                                   <!--5th <?php echo e(\Carbon\Carbon::createFromFormat('M-Y',$invoice->rent_month)->format('M-Y')); ?></span></p>-->
                                            <p class="m-b-10"><strong>Payment Status : </strong>
                                                <span
                                                class="float-right">
                                                    <?php if($invoice->is_paid===1): ?>
                                                    <span style="color: seagreen;">Paid</span>
                                                    <?php elseif($invoice->is_paid===0 && $invoice->paid_in > 0 ): ?>
                                                    <span style="color: orange;">Partial Payment</span>
                                                    <?php else: ?>
                                                    <span style="color: red;">Unpaid</span>
                                                    <?php endif; ?>
                                                    
                                   



                                                </span></p>
                                            <p class="m-b-10"><strong>Invoice No. : </strong> <span
                                                    class="float-right" style="color: royalblue;">#<?php echo e($invoice->id); ?> </span></p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                              <div class="row mt-3">
                                    <div class="col-xs-4">
                                        <p><b>Tenant Details</b> </p>
                                        <address>
                                            <?php echo e($invoice->tenant_name); ?><br>
                                          
                                            Phone Number: +<?php echo e($invoice->tenant_id); ?><br>
                                          
                                        </address>
                                    </div> <!-- end col -->

                                    <div class="col-xs-6">
                                        <p><b>House Details</b> </p>
                                        <address>
                                           
                                           <li>House:  <?php if($invoice->house_id > 0): ?>
                                            <span class="text-success "> <?php echo e($invoice->house->house_no); ?> </span>
                                            
                                            <?php else: ?>
                                            <span class="text-success "> NO HOUSE </span>
                                            
                                            <?php endif; ?>
                                </li>
                                <li>Property: 
                                            <?php if($invoice->apartment_id > 0): ?>
                                            <span class="text-success"> <?php echo e($invoice->house->apartment->name); ?> </span>
                                            
                                            <?php else: ?>
                                            <span class="text-success "> NO APARTMENT </span>
                                            
                                            <?php endif; ?>
                                </li>
                                <li>Property Type: 
                                            <?php if($invoice->house_id > 0): ?>
                                            <span class="text-success "> <?php echo e($invoice->house->house_type); ?> </span>
                                            
                                            <?php else: ?>
                                            <span class="text-success"> NO TYPE INDICATED </span>
                                            
                                            <?php endif; ?> </li>
                             
                                                                       
                                        </address>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table mt-4 table-centered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10%">#</th>
                                                        <th>Bill Description</th>
                                                        <th style="width: 30%" class="text-right">Total</th>
                                                    </tr>
                                                </thead>
                                                 <tbody>
                                  <?php if($invoice->deposit_paid == 0 && $invoice->carryforward == 0 && $invoice->type == 'rent and deposit' ): ?>
                                <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                 <?php elseif($invoice->deposit_paid > 0 && $invoice->carryforward == 0 ): ?>
                                <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                <tr>
                                
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Deposit </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->deposit_paid)); ?></td>
                                </tr>
                               
                               
                                
                                <?php elseif($invoice->carryforward > 0 && $invoice->deposit_paid == 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                
                                 <tr>
                                    
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                
                                <?php elseif($invoice->carryforward > 0 && $invoice->deposit_paid > 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                <tr>
                                
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Deposit </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->deposit_paid )); ?></td>
                                </tr>
                                 <tr>
                                    
                                    <td>3</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                
                                <?php elseif($invoice->carryforward > 0 && $invoice->deposit_paid == 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                
                                 <tr>
                                    
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                
                                <?php elseif($invoice->carryforward > 0 && $invoice->deposit_paid > 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                <tr>
                                
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Deposit </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->deposit_paid )); ?></td>
                                </tr>
                                 <tr>
                                    
                                    <td>3</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                
                                 <?php elseif($invoice->rent > 0 && $invoice->electricity_bill > 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                <tr>
                                
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Deposit </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->deposit_paid )); ?></td>
                                </tr>
                                 <tr>
                                    
                                    <td>3</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                <tr>
                                    
                                    <td>4</td>
                                    <td class="d-none d-sm-table-cell"> Electricity & Water</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->electricity_bill)); ?></td>
                                </tr>
                                <?php elseif($invoice->rent > 0 && $invoice->compound_bill > 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                <tr>
                                
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Deposit </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->deposit_paid )); ?></td>
                                </tr>
                                 <tr>
                                    
                                    <td>3</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                <tr>
                                    
                                    <td>4</td>
                                    <td class="d-none d-sm-table-cell"> Compound Cleaning and Maintenance</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->compound_bill)); ?></td>
                                </tr>
                                 <?php elseif($invoice->rent > 0 && $invoice->litter_bill > 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                <tr>
                                
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Deposit </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->deposit_paid )); ?></td>
                                </tr>
                                 <tr>
                                    
                                    <td>3</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                <tr>
                                    
                                    <td>4</td>
                                    <td class="d-none d-sm-table-cell"> Litter Collection</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->litter_bill)); ?></td>
                                </tr>
                                <?php elseif($invoice->rent > 0 && $invoice->other_bill > 0): ?>
                                 <tr>
                                    <td>1</td>
                                    <td class="d-none d-sm-table-cell"> House Rent </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->rent)); ?></td>
                                </tr>
                                <tr>
                                
                                    <td>2</td>
                                    <td class="d-none d-sm-table-cell"> Deposit </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->deposit_paid )); ?></td>
                                </tr>
                                 <tr>
                                    
                                    <td>3</td>
                                    <td class="d-none d-sm-table-cell"> Arrears</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->carryforward)); ?></td>
                                </tr>
                                <tr>
                                    
                                    <td>4</td>
                                    <td class="d-none d-sm-table-cell"> Other Bills</td>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->other_bill)); ?></td>
                                </tr>
                          
                                
                               
                                
                                <?php else: ?>
                                <tr>
                                    <td>1</td>
                                     <?php if($invoice->type === 'placement'): ?>
                                    <td class="d-none d-sm-table-cell">Placement Fee</td>
                                    <?php elseif($invoice->type === 'management'): ?>
                                    <td class="d-none d-sm-table-cell">Management Fee</td>
                                    <?php elseif($invoice->type === 'viewing'): ?>
                                     <td class="d-none d-sm-table-cell">Viewing Fee</td>
                                     <?php else: ?>
                                     <td class="d-none d-sm-table-cell">Others</td>
                                      <?php endif; ?>
                                    <td class="text-right">Ksh <?php echo e(number_format($invoice->total_payable)); ?></td>
                                </tr>
                                 <?php endif; ?>
                                

                                <?php
                                $count=3;
                                ?>

                                <?php $__empty_1 = true; $__currentLoopData = $billings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $billing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>


                                <tr>
                                    <td> <?php echo e($count++); ?></td>
                                    <td class="d-none d-sm-table-cell"> <?php echo e($billing->billing_name); ?> </td>
                                    <td class="text-right">Ksh <?php echo e(number_format($billing->billing_amount )); ?></td>
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <?php endif; ?>
                            </tbody>
                        </table>
                                            </table>
                                        </div> <!-- end table-responsive -->
                                    </div> <!-- end col -->
                                </div>
                                <br/>
                   
                    
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-xs-9">
                                        <div class="clearfix pt-5">
                                            <h6 class="text-muted">Notes:</h6>

                                            <small class="text-muted">
                                                To be paid by  MPesa Paybill Number <b>743994</b>.<br>
                                                The invoiced tenant has a balance of <strong>Ksh <?php echo e(number_format($invoice->balance)); ?><</strong> <br />
                                            
                                            </small>
                                        </div>
                                        
                                    </div> <!-- end col -->
                                    <div class="col-xs-3  float-right" style="float:right;text-align:right;">
                                        <div class="mt-3 float-right">
                                            <p class="m-b-10"><b>Sub-total:</b> <span class="float-right">Ksh
                                                        <?php echo e(number_format($invoice->total_payable)); ?></span></p>
                                            <!--<p class="m-b-10"><b>Tax:</b> <span class="float-right"> Ksh 0.00</span></p> <hr>-->
                                            <p class="m-b-10"><b>To pay:</b> <span class="float-right"> Ksh <?php echo e(number_format($invoice->total_payable +  $invoice->overpayment)); ?> </span></p>
                                            <p class="m-b-10"><b>Total Paid:</b> <span class="float-right"> Ksh <?php echo e(number_format($invoice->paid_in)); ?> </span></p>
                                            <p class="m-b-10"><b>Balance:</b> <span class="float-right"> Ksh <?php echo e(number_format($invoice->balance)); ?> </span></p>
                                        </div>
                                    </div>
                                    
                                </div>
                                <!-- end row -->
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>
    <!-- END wrapper -->
</body>

</html><?php /**PATH /home/lesaagen/rmslesa/rms/resources/views/invoices/invoiceprint.blade.php ENDPATH**/ ?>