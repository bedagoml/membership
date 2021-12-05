


<?php $__env->startPush('header_scripts'); ?>
<link href="<?php echo e(URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')); ?>"  rel="stylesheet">
<link href="<?php echo e(URL::asset('assets/plugins/datatable/responsive.bootstrap4.min.css')); ?>" rel="stylesheet" />
<!-- Slect2 css -->
<link href="<?php echo e(URL::asset('assets/plugins/select2/select2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="content container-fluid">

    <!-- PAGE-HEADER -->
						<div class="page-header">
							<div>
								<h1 class="page-title"></h1>
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
									<li class="breadcrumb-item"><a href="#">List Members</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</div>
							<div class="ms-auto pageheader-btn">
								<a href="<?php echo e(route('manualinvoice.create', $tenant->id)); ?>" class="btn btn-primary btn-icon text-white me-2">
									<span>
										<i class="fe fe-plus"></i>
									</span> Add Invoice
								</a>
								<?php if($tenant->register_status==0): ?>
								<a href="<?php echo e(route('member.deregister', $tenant->id)); ?>" class="btn btn-danger btn-icon text-white">
									<span>
										<i class="fe fe-x"></i>
									</span> Deregister
								</a>
								<?php else: ?>
								<a href="<?php echo e(route('member.deregister', $tenant->id)); ?>" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-check"></i>
									</span> Register
								</a>
                               
								<?php endif; ?>
                               <?php if($tenant->suspend_status==0): ?>
								<a href="<?php echo e(route('member.suspend', $tenant->id)); ?>" class="btn btn-warning btn-icon text-white">
									<span>
										<i class="fe fe-x"></i>
									</span> Suspend
								</a>
                                <?php else: ?>
								<a href="<?php echo e(route('member.suspend', $tenant->id)); ?>" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-check"></i>
									</span> UnSuspend
								</a>
								<?php endif; ?>
                                <?php if($tenant->status==1): ?>
								<a href="<?php echo e(route('member.approve', $tenant->id)); ?>" class="btn btn-pink btn-icon text-white">
									<span>
										<i class="fe fe-x"></i>
									</span> Disapprove
								</a>
                                <?php else: ?>
								<a href="<?php echo e(route('member.approve', $tenant->id)); ?>" class="btn btn-success btn-icon text-white">
									<span>
										<i class="fe fe-check"></i>
									</span> Approve
								</a>
								<?php endif; ?>
				
							</div>
						</div>
						<!-- PAGE-HEADER END -->
   
    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   


    <div class="tab-content">
<div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
               
                
                </div>
                
            </div>
            <!--details-->
         <div id="emp_profile" class="pro-overview tab-pane fade show active">
            <div class="row">
                 <div class="col-md-4 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            
                                        
                           <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0"><?php echo e($tenant->full_name); ?></h3>
                                        <div class="staff-id">Member Number : <?php echo e($tenant->member_number); ?></div>
                                        <div class="staff-id">Phone Number : <?php echo e($tenant->phone); ?></div>
                                        <div class="small doj text-muted mb-2">Registered :
                                            <?php echo e($tenant->created_at->diffForHumans()); ?></div>
                                        <div class="mb-2"><a class="btn btn-sm btn-primary"
                                                href="<?php echo e(route('tenant.edit', $tenant->id )); ?>">Edit details</a>&nbsp;
                                                <a class="btn btn-sm btn-danger"
                                            href="<?php echo e(route('tenant.changepassword', $tenant->id )); ?>">Change Password</a>
                                        </div>
                                        <div class="mb-2">
                                    </div>
                                      
                                         
                                      
                                        
                                       <!--  <div class=""><a class="btn btn-sm btn-white"
                                                href="<?php echo e(route('tenant.changepassword',$tenant->id)); ?>">Update
                                                Password</a>
                                        </div> -->
                                    </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            <h3 class="card-title"> Details </h3>
                                        
                           <div class="profile-info-left">
                                       
                                        <div class="staff-id"><strong>Account Number :</strong> <?php echo e($tenant->member_number); ?></div>
                                        <div class="staff-id"><strong>Email Address :</strong> <span class="__cf_email__"
                                                        data-cfemail="39535651575d565c795c41585449555c175a5654"><?php echo e($tenant->email); ?></span></div>
                                        <div class="staff-id"><strong>National ID/Passport Number :</strong> <?php echo e($tenant->id_number); ?></div>
                                        <div class="staff-id"><strong>Subcommittees:</strong> <?php echo e($tenant->committees); ?></div>
                                        
                                      
                                         
                                      
                                        
                                       <!--  <div class=""><a class="btn btn-sm btn-white"
                                                href="<?php echo e(route('tenant.changepassword',$tenant->id)); ?>">Update
                                                Password</a>
                                        </div> -->
                                    </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-3 d-flex">
                    <div class="card  flex-fill">
                        <div class="card-body">
                            <h3 class="card-title"> Subscription Details </h3>
                                 <div class="staff-id"><strong>Date :</strong> <?php echo e($tenant->subscription_date); ?> </div>
                                 <div class="staff-id"><strong>Account Status :</strong> 
                                    <?php if($tenant->status == 1): ?>
                                    <span style="color: green;">Registered</span> 
                                    <?php elseif($tenant->status == 0): ?>
                                    <span style="color: red">Deregistered</span>
                                    <?php elseif($tenant->status == 2): ?>
                                    <span style="color: rgb(0, 4, 255)">Suspended</span>
                                    <?php else: ?>
                                    <span style="color: rgb(255, 115, 0)">Pending</span>
                                    <?php endif; ?></div> 
                                        <div class="staff-id"><strong>Balance :</strong> <?php echo e($invoizzy); ?> </div>
                                             
                          
                        </div>
                    </div>
                </div>
                
                </div>
                
            </div>
     
            <!--details-->
 
   
            <div class="row">
                

                <!---Paid Invoice Section---->
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Paid Invoices </h3>
                            <div class="table-responsive">
                                    <table class="table table-striped dt-responsive nowrap" id="invoices-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width:30%">Date</th>
                                            <th style="width:20%">#INV</th>
                                            <th style="width:30%">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $invoiz; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($invoice->created_at); ?></td>
                                            <td>INV00<?php echo e($invoice->id); ?></td>
                                            
                                            
                                            

                                            <!--<td><a href="<?php echo e(route('invoice.show',$invoice->id)); ?>" class="btn btn-sm btn-primary">View</a> </td>-->
                                            <td>
                                                <div class="text-right">
                            <div class="dropdown dropdown-action">
						    	<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item ">
                                        <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('invoice.show', $invoice->id)); ?>"> View</a>
                                    </div>
                                    
                                    

						    	</div>
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
                <!---Payment Section---->
                <div class="col-md-6 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Payments </h3>
                            <div class="table-responsive">
                               
                                <table class="table table-striped dt-responsive nowrap" id="deposit-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <!--<th>#</th>-->
                                            <th style="width:50%;">Date</th>
                                            <th style="width:30%;">Reference</th>
                                            <th style="width:20%;">Amount</th>
                                            
                                        </tr>
                                    </thead>

                                    <?php
                                    $count=1;
                                    ?>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $tenant_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <!--<td><?php echo e($count); ?></td>-->
                                            <td ><?php echo e($deposit->created_at); ?></td>
                                            <td class="text-uppercase"><?php echo e($deposit->TransID); ?></td>
                                            <td class="text-uppercase">Ksh.<?php echo e(number_format( $deposit->TransAmount)); ?></td>
                                            
                                        </tr>

                                        <?php
                                        $count+=1;
                                        ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                        <?php endif; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!---Unpaid Invoice Section---->
               
            </div>
            <div class="row">
                <!---Unpaid Invoice Section---->
                <div class="col-md-12 d-flex">
                    <div class="card profile-box flex-fill">
                        <div class="card-body">
                            <h3 class="card-title">Upcoming Events </h3>
                            <div class="table-responsive">
                                 <table class="table table-striped dt-responsive" id="upcoming_events-table"  style="word-wrap:break-word; table-layout: fixed;  border-spacing: 0; width: 100%;">
                               
                                    <thead>
                                        <tr>
                                            <th >Date</th>
                                            <th style="word-wrap: break-word;">Title</th>
                                            <th style="word-wrap: break-word;">Description</th>
                                            <th >Amount</th>
                                            <th >Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $upcoming_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $evnt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($evnt->meeting_date); ?>- <?php echo e($evnt->meeting_time); ?> (EAT)</td>
                                            <td style="word-wrap: break-word;"><?php echo e($evnt->meeting_title); ?></td>
                                            <td style="word-wrap: break-word;"><?php echo e($evnt->meeting_description); ?></td>
                                            
                                           <td>
                                            <?php if($evnt->meeting_amount == 0): ?>
                                            <span style="color: rgb(0, 6, 95)">Free Event</span>
                                            <?php else: ?>
                                            Ksh. <?php echo e(number_format($evnt->meeting_amount)); ?>

                                            <?php endif; ?></td> 
                                            <td>
                                                
                                                
                                                
                                                
                                                <a class="btn btn-sm btn-info btn-block" href="<?php echo e(route('admin_meeting.invoice', $evnt->id)); ?>"  onclick="event.preventDefault();
                                                    document.getElementById('meeting_invoices').submit();"> Register</a>
                                                <form id="meeting_invoices" action="<?php echo e(route('admin_meeting.invoice', $evnt->id)); ?>" method="POST" style="display: none;">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="tenant_id" value="<?php echo e($tenant->id); ?>"  />
                                                </form></td>
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
        </div>
        <!-- /Profile Info Tab -->



    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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

<script>
    $(function () {
        $(document).ready(function () {
            $('#invoices-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#unpaid-invoices-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#house-table').DataTable(
                {
                    "pageLength": 2,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#balance-table').DataTable(
                {
                    "pageLength": 2,
                    "order": [[ 2, "desc" ]],
                    "bLengthChange": false
                     
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#deposit-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#deposit-list-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<script>
    $(function () {
        $(document).ready(function () {
            $('#tenant-bill-table').DataTable(
                {
                    "pageLength": 12,
                    "bLengthChange": false
                }
            );
        });
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/democlai/public_html/members/rms/resources/views/members/show.blade.php ENDPATH**/ ?>