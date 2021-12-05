@component('mail::message')
# Dear {{$data['name']}},

<br>

This is to notify you that your payment has been received and has been reconciled to the invoice number {{$data['invoice_number']}}, you paid with.
<br><br>Your Payment Details are as below:<br>
# Invoice Number: {{$data['invoice_number']}} <br>
# Transaction Code: {{$data['transaction_code']}} <br>
# Amount Paid: {{$data['amount_paid']}}<br>
# Balance: {{$data['balance']}}
 <br> <br>
 For more details on your invoice, click the button below and login to your membership account.<br>




@component('mail::button', ['url' => 'https://www.demo.claire.co.ke/members/member-login'])
Login 
@endcomponent
<br>
For any enquiries, please write to us at (organization email here...)

Regards,<br>
Demo Membership Management System Administrator
@endcomponent
