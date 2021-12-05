

<?php $__env->startPush('header_scripts'); ?>
<!-- Datetimepicker CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datetimepicker.min.css')); ?>">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<style>
.table-striped th, .table-striped td {
    padding: 0;
}
</style>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="row">
        
    </div>
    <!-- /Page Title -->

    <!-- Content Starts -->
    <div class="card">
    <form action="<?php echo e(route('agency_statement')); ?>" method="get">
        <?php echo csrf_field(); ?>
        
        
        <div class="row">
           

            <div class="col-10">
                <div class="">
                    <div class="card-body">
                        

                        
                        <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        
                        <div class="row">
                            <div class="col-sm-6">
                            <label>From <span
                                    class="text-danger">*</span></label>
                            
                                <div class="form-group">
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" name="from"
                                          placeholder="dd/mm/yyyy"  value="<?php echo e(old('placement_date')); ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                            <label >To<span
                                class="text-danger">*</span></label>
                        
                            <div class="form-group">
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="to"
                                      placeholder="dd/mm/yyyy"  value="<?php echo e(old('placement_date')); ?>">
                                </div>
                            </div>

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
                    <h2>Agency Statement</h2>
                </div>
            </div>
        </div>
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-6">
                            <p><strong>Admin Name:</strong> <span><?php echo e($other_info['name']); ?></span></p>
                            <p><strong>Email:</strong> <span><?php echo e($other_info['email']); ?></span></p>
                            <p><strong>Date of Statement:</strong> <span><?php echo e($other_info['date']); ?></span></p>
                            <p><strong>Statement Period:</strong> <span><?php echo e($other_info['from_to']); ?></span></p>
                        </div> <!-- end col -->
                        <div class="col-xs-6  float-right" style="float:right;text-align:right;">
                            <div class="mt-3 float-right">
                                <img src="https://lesaagencies.co.ke/rms/assets/img/lesa.png" alt="" height="100">
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
                                <th>Reference</th>
                                <th>Details</th>
                                <th>Income</th>
                                <th>Expense</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <th><?php echo e($entry['date']); ?></th>
                                <td><?php echo e($entry['reference']); ?></td>
                                <td><?php echo e($entry['description']); ?></td>
                                
                                <?php if($entry['income'] === '-'): ?>
                                <td>
                                    <?php echo e($entry['income']); ?>

                                </td>
                                <?php else: ?> 
                                <td >
                                    <?php echo e($entry['income']); ?>

                                </td>
                                <?php endif; ?>
                                <?php if($entry['expense'] === '-'): ?>
                                <td>
                                    <?php echo e($entry['expense']); ?>

                                </td>
                                <?php else: ?> 
                                <td >
                                    <?php echo e($entry['expense']); ?>

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
                              <tr>
                                <td>Details</td>
                                <td >Amount</td>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td >Rent Collection Commission</td>
                                    <td ><?php echo e($rent_collection_commission); ?></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td >Placement Fees Income</td>
                                    <td ><?php echo e($placement_fee_income); ?></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td >Other Income</td>
                                    <td ><?php echo e($other_incomes_totals); ?></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td >Total</td>
                                    <td ><?php echo e($income_total); ?></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td >Expenses</td>
                                    <td >-<?php echo e($total_expense); ?></td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td>Balance</td>
                                    <td><?php echo e($balance); ?></td>
                                </tr>
                            </tbody>
                          </table>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <a  href="<?php echo e(\Request::fullUrl()); ?>&download=yes" target="_blank" class="m-2 btn btn-success waves-effect waves-light">Download Statement</a>
                            </div>
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
        </div>
    </div>
<?php endif; ?>

    <!-- /Content End -->

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
     $(document).ready(function() {
    $('.js-example-basic-single').select2();
});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/bedahgra/public_html/rms/work/rms/resources/views/report/agencyform.blade.php ENDPATH**/ ?>