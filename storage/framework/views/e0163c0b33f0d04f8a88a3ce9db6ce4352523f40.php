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
                                         <img src="https://rms.lesaagencies.co.ke/assets/images/lesa.png" alt="Lesa Logo" height="70" width="auto">
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
                                                    <?php echo e($gen_date); ?></span></p>
                                            
                                          
                                                    
                                   



                                                </span></p>
                                            <p class="m-b-10"><strong>Receipt No. : </strong> <span
                                                    class="float-right" style="color: royalblue;">#<?php echo e($receipt_number); ?></span></p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                              <div class="row mt-3">
                                    <div class="col-xs-4">
                                        <p><b>Tenant Details</b> </p>
                                        <address>
                                    
                                             Name: <?php echo e($receipt_data->name); ?> <br>
                                             
                                      
                                       
                                        Phone Number: 
                                             <span class="text-danger "> <?php echo e($receipt_data->phone_number); ?></span><br>
                                          
                                        </address>
                                    </div> <!-- end col -->

                                    <div class="col-xs-6">
                                        <p><b>House Details</b> </p>
                                        <address>
                                           
                                           House:  
                                            <span class="text-success "> <?php echo e($house_number); ?> </span><br>
                                
                                Property: 
                                            
                                            <span class="text-success "> <?php echo e($property); ?> </span><br>
                                         
                                
                                Property Type: 
                                           
                                            <span class="text-success "> <?php echo e($property_type); ?> </span>
                                            
                                            
                             
                                                                       
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
                                                       
                                                        <th>Mode of Payment</th>
                                                        <th>Transaction Code</th>
                                                        <th class="text-right">Amount Paid</th>
                                                        <th style="width: 30%" class="text-right">Balance</th>
                                                    </tr>
                                                </thead>
                                                 <tbody>
                              
                                <tr>
                              
                                    <td class="d-none d-sm-table-cell"><?php echo e($receipt_data->payment_method); ?></td>
                                    <td><?php echo e($receipt_data->transaction_code); ?></td>
                                    <td class="text-right">Kshs <?php echo e($receipt_data->amount); ?></td>
                                    <td class="text-right">Kshs <?php echo e($receipt_data->balance); ?></td>
                                </tr>
                               
                                
                                
                                
                               
                                 
                            
                                
                                    
                                   
                               
                          
                                
                               
                                
                               
                                

                                <?php
                                $count=3;
                                ?>
                            </tbody>
                                            </table>
                                        </div> <!-- end table-responsive -->
                                    </div> <!-- end col -->
                                </div>
                                <br/>
                   
                    
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

</html><?php /**PATH /home/lesaagen/rmslesa/rms/resources/views/receipt/index.blade.php ENDPATH**/ ?>