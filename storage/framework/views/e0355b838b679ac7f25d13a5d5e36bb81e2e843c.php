<?php $__env->startSection('css'); ?>
<!-- Data table css -->
<link href="<?php echo e(URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>"  rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
<!-- Slect2 css -->
<link href="<?php echo e(URL::asset('assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="content container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
               
            </div>
        </div>
        <div class="mb-2"><a class="btn btn-sm btn-danger"
            href="<?php echo e(route('meeting.list')); ?>">Back to the list</a>
    </div>
    </div>
    <!-- /Page Header -->

    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="job-info job-widget">
                <h3 class="job-title"><?php echo e($projects->project_title); ?></h3>
               
                <ul class="job-post-det mb-2">
                   
                              <li><i class="fa fa-calendar"></i> Project Registered: <span
                            class="text-blue"><?php echo e($projects->created_at->diffForHumans()); ?></span></li>
                   
                           
                </ul>
            </div>
            <div class="job-content job-widget">
                <div class="job-desc-title"><div class="row">
							<div class="col-12">
								
					

								
								<!--div-->
							<!---Invoice Section---->
                <div class="col-md-12 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">List of Donations </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-nowrap datatable" id="invoices-table">
                                    <thead>
                                        <tr>
                                            <th >First Name</th>
                                            <th >Last Name</th>
                                            <th >Phone Number</th>
                                            <th >Amount</th>
                                            <th >Method</th>
                                            <th >Transaction Code</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($invoice->FirstName); ?></td>
                                            <?php if($invoice->LastName == null): ?>
                                            <td><?php echo e($invoice->MiddleName); ?></td>
                                            <?php else: ?>
                                            <td><?php echo e($invoice->LastName); ?></td>
                                            <?php endif; ?>
                                            <td><?php echo e($invoice->MSISDN); ?></td>
                                            <td><?php echo e($invoice->TransAmount); ?></td>
                                            <td><?php echo e($invoice->TransactionType); ?></td>
                                            <td><?php echo e($invoice->TransID); ?></td>
                                            

                                           
                                        </tr>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
								<!--/div-->

								
										</div>
									</div>
                    
                </div>
               

            </div>
        </div>
        <div class="col-md-4 order-first">
            <div class=" card">
                <div class="card-body">
                   <hr class="pt-4">

                   
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-money"></i></span> Total Donations</h5>
                        <p><?php echo e($donations); ?></p>
                       
                      
                    </div>
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-calendar"></i></span> Deadline Date</h5>
                        <p><?php echo e($projects->project_date); ?></p>
                    </div>
                   
                    
                    
                    
                    <div class="info-list">
                       
                        <h5> <span><i class="fa fa-map-signs"></i></span> Description</h5>
                        <p> <?php echo e($projects->project_description); ?></p>
                    </div>
                    <hr class="pt-4">
                    

                 
                </div>


            </div>
        </div>
       
    </div>


</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<script>
    $(function () {
        $(document).ready(function () {
            $('#invoices-table').DataTable(
                {   
                    "order": [[ 0, "desc" ]],
                    "pageLength": 8,
                    "bLengthChange": false
                }
            );
        });
    });
</script>

<!-- Data tables -->
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/jszip.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/vfs_fonts.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/datatables.js')); ?>"></script>
<!-- Select2 js -->
<script src="<?php echo e(URL::asset('assets/plugins/select2/select2.full.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\rotary\rotary\resources\views/contributions/show.blade.php ENDPATH**/ ?>