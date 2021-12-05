

<?php $__env->startSection('content'); ?>

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-9">
                
                
            </div>
            <div>
                <a href="<?php echo e(route('admin.create')); ?>" class="btn btn-success">
                    Add User</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->


<div class="card" style="padding-top:25px; padding-bottom:25px; padding-left:25px; padding-right:25px;">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">

                <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <table class="table table-striped " >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User-Name</th>
                            <th>Phone Number</th>
                            <th>Role</th>
                            
                            <th style="width: 10%;">Password</th>
                            <th style="width: 10%;">Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php echo e($user->name); ?>

                            </td>
                            <td><?php echo e($user->username); ?></td>
                            <td><?php echo e($user->user_id); ?></td>
                            <td>
                               <ul>
                                 <?php if($user->member_creating===1): ?>
                                <li><span>Create Members</span></li>
                                <?php endif; ?>
                                <?php if($user->member_viewing===1): ?>
                                <li><span >View Members</span></li>
                                <?php endif; ?>
                                <?php if($user->member_editing_delete===1): ?>
                                <li><span >Edit & Delete Members</span></li>
                                <?php endif; ?> 
                                 <?php if($user->event_creating===1): ?>
                                <li><span>Create Events</span></li>
                                <?php endif; ?>
                                <?php if($user->event_viewing===1): ?>
                                <li><span >View Events</span></li>
                                <?php endif; ?>
                                <?php if($user->event_editing_delete===1): ?>
                                <li><span >Edit & Delete Events</span></li>
                                <?php endif; ?>
                                 <?php if($user->invoice_creating===1): ?>
                                <li><span>Create & Pay Invoices</span></li>
                                <?php endif; ?>
                                <?php if($user->invoice_viewing===1): ?>
                                <li><span >View Invoices</span></li>
                                <?php endif; ?>
                                <?php if($user->invoice_editing_delete===1): ?>
                                <li><span >Edit & Delete Invoice</span></li>
                                <?php endif; ?>
                                 <?php if($user->setting_creating===1): ?>
                                <li><span>Create System Settings</span></li>
                                <?php endif; ?>
                                <?php if($user->setting_editing_delete===1): ?>
                                <li><span >Edit & Delete Settings</span></li>
                                <?php endif; ?>
                                 <?php if($user->user_creating===1): ?>
                                <li><span>Create System Users</span></li>
                                <?php endif; ?>
                                <?php if($user->user_viewing===1): ?>
                                <li><span >View System Users</span></li>
                                <?php endif; ?>
                                <?php if($user->user_editing_delete===1): ?>
                                <li><span >Edit & Delete System Users</span></li>
                                <?php endif; ?>
                                <?php if($user->report_viewing===1): ?>
                                <li><span >View Reports</span></li>
                                <?php endif; ?>
                               </ul>
                                
                            </td>
                            <!--<td>-->

                            <!--    <form action="<?php echo e(route('admin.toggleRole',$user->id)); ?>" method="post">-->
                            <!--        <?php echo csrf_field(); ?>-->
                            <!--        <?php if($user->is_admin===1): ?>-->
                            <!--        <input type="submit" class="btn btn-success btn-sm " value="Make Agent">-->
                            <!--        <?php elseif($user->is_super===1 && $user->is_admin===1 ): ?>-->
                            <!--        <input type="submit" class="btn btn-secondary btn-sm" value="Make Office Manager">-->
                            <!--        <?php else: ?>-->
                            <!--        <input type="submit" class="btn btn-danger btn-sm" value="Make Administrator">-->
                            <!--        <?php endif; ?>-->
                            <!--    </form>-->



                            <!--</td>-->
                            <td>

                                 <div class="dropdown-item ">
                                                <a class="btn btn-sm btn-success btn-block" href="<?php echo e(route('admin.editpassword', $user->id)); ?>"> Edit</a>
                                            </div>



                            </td>
                            <td>
                                <div class="text-right">
            <div  class=" dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fa fa-ellipsis-v "></i>
            </div>
            <div class="dropdown-menu" role="menu">
                
            <div class="dropdown-item ">
                                                <a class="btn btn-info btn-block" href="<?php echo e(route('admin.edit', $user->id)); ?>"> Edit</a>
                                            </div>
                                             <div class="dropdown-item ">
                                                <form action="<?php echo e(route('admin.delete',$user->id)); ?>" method="post" class="delete-form">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                
                                                    <input type="submit" class="btn btn-danger btn btn-block" value="Delete">
                                                </form>
                                                <!--<a class="btn btn-danger btn-block" href="<?php echo e(route('admin.delete', $user->id)); ?>"> Delete</a> -->
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
</div>
<!-- /Page Content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_scripts'); ?>
<script>
   $(document).on('submit','.delete-form',function(event){
           return confirm(" Are you sure you want to delete this admin ? ");
   });

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/democlai/public_html/members/rms/resources/views/authorization/listadmins.blade.php ENDPATH**/ ?>