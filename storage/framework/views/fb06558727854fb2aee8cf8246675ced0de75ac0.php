

<?php $__env->startSection('content'); ?>

<div class="content container-fluid">

    <!-- Page Title -->
    
    <!-- /Page Title -->

    <!-- Content Starts -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    
                    <p class="text-muted m-b-30 font-14">After successful registration of the tenant, proceed and click assign house button to add tenant to a house.
                    </p>
                    <?php echo $__env->make('includes.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="p-20 pt-2">
                        <form action="<?php echo e(route('tenant.store')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label>Full Names <span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" class="form-control" name="full_name"
                                                value="<?php echo e(old('full_name')); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone Number (ID) <span class="text-danger">*</span></label>
                                        <div>
                                            <input type="text" class="form-control" name="id"
                                                value="<?php echo e(old('id')); ?> ">
                                        </div>
                                    </div>
                                </div>

                                
                               
                            </div>
                            <!-- end row -->
                            <div class="row">
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>National ID Number / Passport </label>
                                        <div>
                                            <input type="text" class="form-control" name="id_number" value="" id="passport">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <div>
                                            <input type="text" class="form-control" name="email"
                                                value="<?php echo e(old('email')); ?> ">
                                        </div>
                                    </div>
                                </div>
                                

                                

                                
                                 <div class="col-sm-4">                                
                                    <div class="form-group">
                                        <label>Occupation Status:</label>
                                        <div>
                                            <select class="select" name="occupation">
                                                <option value="0">--choose--</option>
                                                <option>Employed</option>
                                                <option>Self-Employed</option>
                                                <option>Student</option>
                                                <option>Unemployed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                     <div class="form-group">
                                            <label>Tenant Contract</label>
                                            <div>
                                                <input type="file" name="filenames" class="myfrm form-control">
                                            </div>
                                        </div>
                                </div>
                            </div>
                            
                            <div class="row">
                               
                                
                                
                                
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                                <div class="col-sm-12">
                                    <p class="text-muted m-b-30 font-14">CONTACT PERSON
                                    </p>
                                </div>

                            </div>
                            <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Names</label>
                                    <div>
                                        <input type="text" class="form-control" name="emergency_person" value="<?php echo e(old('emergency_person')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <div>
                                        <input type="tel" class="form-control" name="emergency_number" value="<?php echo e(old('emergency_number')); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Relationship:</label>
                                    <div>
                                        <input type="text" class="form-control" name="relationship" value="">
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div>
                                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="float-right" style="padding-right: 15px;" style="padding-top: 15px;" >
                            <div class="row sm-6">
                                <div class="">
                                    <div class="form-group">
                                        <div>
                                            
                                            <a href="<?php echo e(route('tenant.assign_room')); ?>"><button  class="btn btn-info ">
                                                Assign House
                                            </button></a>    
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- /Content End -->

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('footer_scripts'); ?>
    <script>
    $('#passport').keyup(function(){
        $('#password').val($(this).val());
    });
    </script>    

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/bedahgra/public_html/lesa-demo/rms/resources/views/tenants/register.blade.php ENDPATH**/ ?>