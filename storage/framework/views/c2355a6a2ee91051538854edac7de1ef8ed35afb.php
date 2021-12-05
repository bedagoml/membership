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
    <style>
    .table-striped th, .table-striped td {
    padding: 0;
}
    </style>
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <div class="row">
            <div class="col-12">
                <div class="title text-center">
                    <h2>Property Owner Statement</h2>
                </div>
            </div>
        </div>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <p><strong>Property Owner Name:</strong> <span><?php echo e($other_info['name']); ?></span></p>
                            <p><strong>Property Name:</strong> <span><?php echo e($other_info['apart_name']); ?></span></p>
                            <p><strong>Telephone:</strong> <span><?php echo e($other_info['phone']); ?></span></p>
                            <p><strong>Date of Statement:</strong> <span><?php echo e($other_info['date']); ?></span></p>
                            <p><strong>Statement Period:</strong> <span><?php echo e($other_info['from_to']); ?></span></p>
                        </div> <!-- end col -->
                        <div class="col-xs-6  float-right" style="float:right;text-align:right;">
                            <div class="mt-3 float-right">
                                <img src="https://rms.lesaagencies.co.ke/assets/images/lesa.png" alt="Your Logo Here" height="100">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="title text-center">
                            <h4>Detailed Statement</h4>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Description</th>
                                <th>Reference</th>
                                <th>Amount</th>
                                <th>Paid</th>
                                <!--<th>Commission</th>-->
                              </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $property_owner_info_array_info; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <td><?php echo e($entry['date']); ?></td>
                                <td><?php echo e($entry['description']); ?></td>
                                <td><?php echo e($entry['reference']); ?></td>
                                <td><?php echo e($entry['amount']); ?></td>
                                <td><?php echo e($entry['paid']); ?></td>
                              </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                          </table>
                    </div>
                    <div class="col-12">
                        <div class="title text-center">
                            <h4>Summary</h4>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <td>Details</td>
                                <td >Amount</td>
                                <td >Paid</td>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rent</td>
                                    <td >Ksh.200,000</td>
                                    <td>-</td>
                                </tr>
                                <tr>
                                    <td>Service Request Bills</td>
                                    <td >Ksh.5,000</td>
                                    <td >-</td>
                                </tr>
                                <tr>
                                    <td>Electricity Bills</td>
                                    <td >Ksh.200</td>
                                    <td >-</td>
                                </tr>
                                 <tr>
                                    <td>Litter Bills</td>
                                    <td >Ksh.10,000</td>
                                    <td >-</td>
                                </tr>
                                 <tr>
                                    <td>Compound Cleaning & Maintenance Bills</td>
                                    <td >Ksh.200</td>
                                    <td >-</td>
                                </tr>
                                 <tr>
                                    <td>Security Bills</td>
                                    <td >Ksh.200</td>
                                    <td >-</td>
                                </tr>
                                <tr>
                                    <td>Water Bills</td>
                                    <td >Ksh.200</td>
                                    <td >-</td>
                                </tr>
                                <tr>
                                    <td>Paid Service Request Bills</td>
                                    <td >-</td>
                                    <td >Ksh.5,000</td>
                                </tr>
                                <tr>
                                    <td>Paid Electricity Bills</td>
                                    <td >-</td>
                                    <td >Ksh.200</td>
                                </tr>
                                 <tr>
                                    <td>Paid Litter Bills</td>
                                    <td >-</td>
                                    <td >Ksh.10,000</td>
                                </tr>
                                 <tr>
                                    <td>Paid Compound Cleaning & Maintenance Bills</td>
                                    <td >-</td>
                                    <td >Ksh.200</td>
                                </tr>
                                 <tr>
                                    <td>Paid Security Bills</td>
                                    <td >-</td>
                                    <td >Ksh.200</td>
                                </tr>
                                <tr>
                                    <td>Water Bills</td>
                                    <td >-</td>
                                    <td >Ksh.200</td>
                                </tr>
                                <tr>
                                    <td>Rent Paid</td>
                                    <td >-</td>
                                    <td>Ksh.180,000</td>
                                </tr>
                                <tr>
                                    <td>Commission</td>
                                    <td >Ksh.20,000</td>
                                    <td >-</td>
                                </tr>
                                <tr>
                                    <th>Sub Total</th>
                                    <th >Ksh.197,800</th>
                                    <th >Ksh.197,800</th>
                                </tr>
                                <tr>
                                    <th>Balance</th>
                                    <th >Ksh.0</th>
                                   
                                </tr>
                            </tbody>
                          </table>
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>
    <!-- END wrapper -->
</body>

</html><?php /**PATH /home/lesaagen/rmslesa/rms/resources/views/docs/propertyOwnerStatement.blade.php ENDPATH**/ ?>