
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
                <h3 class="job-title"><?php echo e($event->meeting_title); ?></h3>
                 <!--<h6 class="job-title"><?php echo e($event->meeting_description); ?></h6>-->
                <ul class="job-post-det mb-2">
                   
                              <li><i class="fa fa-calendar"></i> Event Registered: <span
                            class="text-blue"><?php echo e($event->created_at->diffForHumans()); ?></span></li>
                   
                           
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
                            <h3 class="card-title">List of Registered Members </h3>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-nowrap datatable" id="invoices-table">
                                    <thead>
                                        <tr>
                                            <th >Member Number</th>
                                            <th >Member Name</th>
                                            <th >Phone Number</th>
                                            <th >Email</th>
                                            <th >Status</th>
                                            <th >Paid</th>
                                            <th >Balance</th>
                                            <th >Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($invoice->tenant->member_number); ?></td>
                                            <td><?php echo e($invoice->tenant->member_name); ?></td>
                                            <td><?php echo e($invoice->tenant->phone); ?></td>
                                            <td><?php echo e($invoice->tenant->email); ?></td>
                                            <td>
                                                <?php if($invoice->is_paid > 0): ?>
                                                <span class="badge badge-success">PAID  
                                                <?php elseif($invoice->is_paid == 0 && $invoice->paid_in > 0 ): ?>
                                                <span class="badge badge-warning">PARTIAL</span>
                                                <?php else: ?> <span
                                                    class="badge badge-danger">UNPAID</span> <?php endif; ?>
                                            </td>
                                            <td><?php echo e($invoice->paid_in); ?></td>
                                            <td><?php echo e($invoice->balance); ?></td>
                                            

                                            <!--<td><a href="<?php echo e(route('invoice.show',$invoice->id)); ?>" class="btn btn-sm btn-primary">View</a> </td>-->
                                            <td>
                                                <?php if($invoice->total_payable > 0): ?>
                                                <div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('invoice.show', $invoice->id)); ?>"> View</a>
                                    </div>
                                    <!--<div class="dropdown-item ">-->
                                    <!--    <a class="btn btn-sm btn-success btn-block" href="<?php echo e(route('invoice.edit', $invoice->id)); ?>"> Edit</a>-->
                                    <!--</div>-->
                                    

						    	</div>
                            </div>
                        </div>
                        <?php endif; ?>
                                                
                                            </td>
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
                        
                        <h5><span><i class="fa fa-users"></i></span> Registered Members</h5>
                        <p><?php echo e($events); ?></p>
                       
                      
                    </div>
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-calendar"></i></span> Event Date</h5>
                        <p><?php echo e($event->meeting_date); ?></p>
                    </div>
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-clock-o"></i></span> Event Time</h5>
                        <p><?php echo e($event->meeting_time); ?> (EAT)</p>
                    </div>
                    <div class="info-list">
                        
                        <h5><span><i class="fa fa-money"></i></span> Charges</h5>
                        <p>
                            <?php echo e($event->meeting_amount); ?></p>
                    </div>
                    
                    
                    
                    <div class="info-list">
                       
                        <h5> <span><i class="fa fa-map-signs"></i></span> Description</h5>
                        <p> <?php echo e($event->meeting_description); ?></p>
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




<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/democlai/public_html/members/rms/resources/views/meeting/show.blade.php ENDPATH**/ ?>