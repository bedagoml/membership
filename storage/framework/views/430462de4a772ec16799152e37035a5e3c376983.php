
<?php $__env->startSection('css'); ?>
<!-- Data table css -->
<link href="<?php echo e(URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>"  rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
<!-- Slect2 css -->
<link href="<?php echo e(URL::asset('assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
						<!--Page header-->
						<div class="page-header">
						
							<div class="page-rightheader ml-auto d-lg-flex d-none">
								<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="d-flex"><span>Home</span></a></li>
									<!--<li class="breadcrumb-item"><a href="#">Forms</a></li>-->
									<li class="breadcrumb-item active" aria-current="page">All Events</li>
								</ol>
							</div>
						</div>
						<!--End Page header-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
						<!-- Row -->
			 <div class="row">
        
        <div class="col-md-12">
            <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        
                         <table class="table table-striped dt-responsive" id="upcoming_events-table"  style="word-wrap:break-word; table-layout: fixed;  border-spacing: 0; width: 100%;">
                               
                            <thead>
                                <tr>
                                    <th style="word-wrap: break-word;">Title</th>
                                    <th >Date</th>
                                    <th >Time</th>
                                    
                                   <th >Event Cost</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $event_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                   
                                    <td style="word-wrap: break-word;"><?php echo e($event->meeting_title); ?></td>
                                    <td><?php echo e($event->meeting_date); ?></td>
                                   
                                    <td><?php echo e($event->meeting_time); ?> (EAT) </td>
                                   
                                    
                                    <td>
                                    <?php if($event->meeting_amount == 0): ?>
                                    <span style="color: rgb(0, 6, 95)">Free Event</span>
                                    <?php else: ?>
                                    Ksh. <?php echo e(number_format($event->meeting_amount)); ?>

                                    <?php endif; ?></td> 
                                    
                                   
                                   
                                    <!--<td style="word-wrap: break-word;"><?php echo e($event->meeting_description); ?></td>-->
                                    <td>
                                        <div class="text-right">
                            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa fa-ellipsis-v "></i>
                            </div>
                            <div class="dropdown-menu" role="menu">
                             <?php if(Auth::user()->event_viewing==1 ): ?>
                           <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('meeting.show', $event->id)); ?>"> View</a>
                                    </div>
                                    <?php endif; ?>
                                     <?php if( Auth::user()->event_editing_delete==1  ): ?>
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-success btn-block" href="<?php echo e(route('meeting.edit', $event->id)); ?>"> Edit</a>
                                    </div>
                                    <?php endif; ?>
                            </div>
                        </div>
                                               
                                                
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
    </div>
							
						<!-- /Row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<!-- Data tables -->
<script>
    $(function () {
        $(document).ready(function () {
            $('#upcoming_events-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/democlai/public_html/members/rms/resources/views/meeting/list.blade.php ENDPATH**/ ?>