<?php $__env->startComponent('mail::message'); ?>
# Dear <?php echo e($data['name']); ?>,

<br>

Welcome to Demo Membership Management System, we are glad you have joined us. Your account is successfully created and verified. <br>
You now have access to your invoices, events updates and power to register for events with a click.
<br><br>Below are your login credentials:<br>
# Email: <?php echo e($data['member_email']); ?> <br>
# Password: <?php echo e($data['member_password']); ?>

 <br> <br>
 Click the button below and login.<br>




<?php $__env->startComponent('mail::button', ['url' => 'https://www.demo.claire.co.ke/members/member-login']); ?>
Login 
<?php echo $__env->renderComponent(); ?>

Regards,<br>
Demo Membership Management System Administrator
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/democlai/public_html/members/rms/resources/views/emails/onClientPayment.blade.php ENDPATH**/ ?>