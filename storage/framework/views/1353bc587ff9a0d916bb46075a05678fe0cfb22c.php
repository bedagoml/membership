<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Income Statement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App css -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <link href=" <?php echo e(asset('assets/css/invoice_style.css')); ?> " rel="stylesheet" type="text/css" />
   
</head>

<body>
    <!-- Begin page -->
    <div id="wrapper">
        <div class="row">
            <div class="col-12">
                <div class="title text-center">
                    <h2>INCOME STATEMENT</h2>
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
                        <div class="title text-center">
                            <h4>Detailed Income Statement</h4>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <thead>
                               
                              <tr style="padding-top:0px; padding-bottom:0px;">
                                <th style="padding-top:0px; padding-bottom:0px;">Date</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Member Name</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Description</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Reference</th>
                                <th style="padding-top:0px; padding-bottom:0px;">Income Amount</th>
                              </tr>
                            </thead>
                            <tbody style="padding-top:0px; padding-bottom:0px;">
                                <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <th style="padding-top:0px; padding-bottom:0px;"><?php echo e($entry['date']); ?></th>
                                <th style="padding-top:0px; padding-bottom:0px;"><?php echo e($entry['member_name']); ?></th>
                                <td style="padding-top:0px; padding-bottom:0px;"><?php echo e($entry['description']); ?></td>
                                <td style="padding-top:0px; padding-bottom:0px;"><?php echo e($entry['reference']); ?></td>
                                
                               

                                <?php if($entry['paid_in'] === '-'): ?>
                                <td style="padding-top:0px; padding-bottom:0px;">
                                    <?php echo e($entry['paid_in']); ?>

                                </td>
                                <?php else: ?> 
                                <td style="padding-top:0px; padding-bottom:0px;">
                                    <?php echo e(number_format($entry['paid_in'],2)); ?>

                                </td>
                                <?php endif; ?>
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
                              <tr style="padding-top:0px; padding-bottom:0px;">
                                <td style="padding-top:0px; padding-bottom:0px;">Details</td>
                                <td style="padding-top:0px; padding-bottom:0px;" >Payment</td>
                              </tr>
                            </thead>
                            <tbody style="padding-top:0px; padding-bottom:0px;">
                               
                                
                                
                               
                                <tr style="padding-top:0px; padding-bottom:0px;">
                                    <td style="padding-top:0px; padding-bottom:0px;">Payments</td>
                                    <td style="padding-top:0px; padding-bottom:0px;"><?php echo e($payments); ?></td>
                                </tr>
                                <tr style="padding-top:0px; padding-bottom:0px;">
                                    <th style="padding-top:0px; padding-bottom:0px;">Total</th>
                                    <th style="padding-top:0px; padding-bottom:0px;"><?php echo e($payments); ?></th>
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

</html><?php /**PATH /home/democlai/public_html/members/rms/resources/views/docs/incomeStatement.blade.php ENDPATH**/ ?>