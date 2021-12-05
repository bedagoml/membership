@component('mail::message')
# Dear {{$data['name']}},

<br>

Welcome to Demo Membership Management System, we are glad you have joined us. Your account is successfully created and verified. <br>
You now have access to your invoices, events updates and power to register for events with a click.
<br><br>Below are your login credentials:<br>
# Email: {{$data['member_email']}} <br>
# Password: {{$data['member_password']}}
 <br> <br>
 Click the button below and login.<br>




@component('mail::button', ['url' => 'https://www.demo.claire.co.ke/members/member-login'])
Login 
@endcomponent

Regards,<br>
Demo Membership Management System Administrator
@endcomponent
