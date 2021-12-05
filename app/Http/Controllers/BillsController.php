<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Apartment;
use App\Bills;
use App\BillsPayment;
use App\BillManagerPayments;
use App\Contribution;
use App\Http\Requests\BillsRequest;
use App\PayOwners;
use App\Invoice;
use App\Landlord;
use App\ServiceRequests;
use App\Tenant;
use App\Traits\UtilTrait;
use App\Traits\DocTrait;
use App\User;
use Carbon\Carbon as CarbonCarbon;
use DB;
use Hash;
use PDF;
class BillsController extends Controller
{
    use UtilTrait;
    use DocTrait;

    public function create()
    {
        $projects = Contribution::get();
        $tenants = Tenant::pluck('id', 'full_name');
        $users = User::all();
        return view('bills.create', compact('tenants', 'projects','users'));

    }

    public function pay()
    {
       
        $payowners = PayOwners::where('approval', '1')->get();
        
        return view('bills.pay', compact('payowners'));
    }

    function list() {
        return view('payowners.list');
    }
     function payments() {
        return view('bills.payments');
    }
    function paymentlist() {
        return view('bills.paymentlist');
    }

    public function store(BillsRequest $request)
    { 


        $var = CarbonCarbon::now()->format('M-Y');
        if( $request->bill_type == "Project"){

            $bills = new PayOwners;
            // $bills->id = $request->id;
            $bills->bill_source = $request->bill_source;
            
            $bills->bill_type = $request->bill_title;
            $bills->agency_user = $request->agency_user;
            $bills->total_owned = $request->bill_amount;
            $bills->balance = $request->bill_amount;
            $bills->description = $request->bill_description;
            $bills->rent_month = $var;
            $bills->save();
        }else{
            $bills = new PayOwners;
            // $bills->id = $request->id;
            $bills->bill_source = $request->bill_sources;
            
            $bills->bill_type = $request->bill_titles;
            $bills->agency_user = $request->agency_users;
            $bills->total_owned = $request->bill_amounts;
            $bills->balance = $request->bill_amounts;
            $bills->description = $request->bill_descriptions;
            $bills->rent_month = $var;
            $bills->save();
        }
        
       
        
    

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Bill Created',
            'more_info' => 'Bill Type ' . $request->bill_type,
            'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'subscription_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
        ]);

        

        return back()->with('success', 'Bill has been raised to the system');
    

    }
    public function paymentdelete($id)
    {
        $payments = BillManagerPayments::findOrFail($id);
       $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Manual Bill Payment Deleted',
            'more_info' => 'It was a pending bill payment',
            'servicerequest_id' => '0',
            'tenant_id' => '0',
            'house_id' => '0',
            'apartment_id' => '1',
            'landlord_id' => '1',
            'subscription_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
         
        ]);
        $payments->delete();

        return back()->with('success', 'Pending Payment has been deleted from system');

    }
     public function paymentedit($id)
    {
        
        $managerpayment = BillManagerPayments::findOrFail($id);
        $payowners = PayOwners::pluck('id', 'apartment_id','landlord_id');
       
        $tenants = Tenant::pluck('id', 'full_name');
        
        return view('payowners.paymentedit', compact('managerpayment', 'payowners', 'tenants'));
    }
    public function payManagerNow(Request $request)
    {
        $attributes = $request->validate([
            'apartment_id' => 'nullable',
            'type' => 'nullable',
            'reference' => 'required',
            'amount' => 'required',
            'payment_date' =>'required',
            'agency_user' =>'nullable',
            'service_Provider' =>'nullable',
            'agency_service_provider' => 'nullable',
            'agency_bill_for' => 'nullable',
            'bill_for' =>'nullable',
            'payment_type' =>'required',
            'landlord_id' =>'nullable',
            'id' =>'nullable',
            
        ]);
        if ($attributes['type'] === 'agency') {
            $pay = PayOwners::where('id', $attributes['landlord_id'])->first();
            if ($pay) {
                $payment = BillManagerPayments::create([
                    'TransactionType' => $attributes['payment_type'],
                    'MSISDN' => $attributes['landlord_id'],
                    'TransID' => $attributes['reference'],
                    'bill_for' => $attributes['agency_bill_for'],
                    // 'service_provider' => $attributes['agency_service_provider'],
                    'TransAmount' => $attributes['amount'],
                    'full_name' => 'Agency Bill',
                    'InvoiceNumber' => $attributes['reference'],
                    'Manager' => auth()->user()->username,
                    'payment_date' => $attributes['payment_date'],
                    'bill_type' => 'agency',
                    'status' => '0',
                ]);
                // $pay_status = $pay->balance - $attributes['amount'] > 0 ? 0 : 1;
                // $balance = $pay->balance - $attributes['amount'];
                // $pay->update([
                //     'pay_status' => $pay_status,
                //     'balance' => $balance,
                //     'paid_in' => $attributes['amount'],
                    
                // ]);
               if($pay->landlord_id == null){
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Manager Bill Payment',
                    'more_info' => 'Bill Type: Bill',
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '1',
                    'subscription_id' => '0',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
                }
                else{
                   $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Manager Bill Payment',
                    'more_info' => 'Bill Type: Bill '  . $pay->landlord->full_name,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => $pay->landlord_id,
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'subscription_id' => '0',
                    'servicerequest_id' => '0',
                ]); 
                }
            }

            return back()->with('success', 'Payment added successfully pending authorization from the Administrator');
        }elseif ($attributes['type'] === 'owner_expense') {
            $pay = PayOwners::where('id', $attributes['landlord_id'])->first();
            if ($pay) {
                $payment = BillManagerPayments::create([
                    'TransactionType' => $attributes['payment_type'],
                    'MSISDN' => $attributes['landlord_id'],
                    'TransID' => $attributes['reference'],
                    'TransAmount' => $attributes['amount'],
                    'bill_for' => $attributes['bill_for'],
                    // 'service_provider' => $attributes['service_provider'],
                    'full_name' => $pay->apartment->name,
                    'InvoiceNumber' => $attributes['reference'],
                    'Manager' => auth()->user()->username,
                    'payment_date' => $attributes['payment_date'],
                    'bill_type' => 'agency',
                    'status' => '0',
                ]);
                // $pay_status = $pay->balance - $attributes['amount'] > 0 ? 0 : 1;
                // $balance = $pay->balance - $attributes['amount'];
                // $pay->update([
                //     'pay_status' => $pay_status,
                //     'balance' => $balance,
                //     'paid_in' => $attributes['amount'],
                    
                // ]);
               if($pay->landlord_id == null){
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Manager Expense Bill Payment',
                    'more_info' => 'Bill Type: Expense Bill',
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'subscription_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
                }
                else{
                   $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Manager Bill Payment',
                    'more_info' => 'Bill Type: Bill '  . $pay->landlord->full_name,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => $pay->landlord_id,
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'subscription_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]); 
                }
            }

            return back()->with('success', 'Payment added successfully pending authorization from the Administrator');
        }else{
             $pay = PayOwners::where('id', $attributes['apartment_id'])->first();
            $payment = BillManagerPayments::create([
                'TransactionType' => $attributes['payment_type'],
                'MSISDN' => $attributes['apartment_id'],
                'TransID' => $attributes['reference'],
                'TransAmount' => $attributes['amount'],
                'full_name' => $pay->apartment->name,
                'Manager' => auth()->user()->username,
                'InvoiceNumber' => $attributes['reference'],
                'payment_date' => $attributes['payment_date'],
                'bill_type' => 'property',
                'status' => '0',
            ]);
             $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Bill Payment',
                    'more_info' => 'Bill Type: Property Bill ' . $pay->apartment->name . ' Amount: Ksh.' . $payment->TransAmount,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => $pay->apartment->id,
                    'landlord_id' => '0',
                    'bill_id' => '0',
                    'invoice_id' => '0',
                    'subscription_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
            // $payment = ManualPayment::where('MSISDN', '254700088168')->first();
            // $landlord_invoices_to_pay =PayOwners::where('apartment_id', $attributes['apartment_id'])->get();
            // $balance_reached = $this->updateClientInvoices($landlord_invoices_to_pay, $payment->TransAmount);
            return back()->with('success', 'Payment added successfully pending authorization from the Administrator');
        }
        

    }
    
     public function payNowUpdate(Request $request, $id)
    {
        $approve_pymt = BillManagerPayments::find($id);
        $pay = PayOwners::where('id', $approve_pymt->MSISDN)->first(); 
        // $tenant = Tenant::where('id', $approve_pymt->tenant_id)->first();
        $pymt = BillsPayment::where('TransID', $approve_pymt->TransID)->first();
        

        if ($pymt) {
            return back()->with('error', 'Payment with transaction code ' . $approve_pymt->TransID . ' has already been added');
        }
        if ($pay->bill_type === 'agency') {
            // $pay = PayOwners::where('id', $attributes['landlord_id'])->first();
            if ($pay) {
                 $approve_pymt->update([
                    'status' => $request->approval,
                   
                ]);
                $status = $request->approval;
                if($status == 1){
                $payment = BillsPayment::create([
                    'TransactionType' => $approve_pymt->TransactionType,
                    'MSISDN' => $approve_pymt->MSISDN,
                    'TransID' => $approve_pymt->TransID,
                    'TransAmount' => $approve_pymt->TransAmount,
                    // 'service_provider' => $approve_pymt->service_provider,
                    'bill_for'=> $approve_pymt->bill_for,
                    'InvoiceNumber' => $approve_pymt->InvoiceNumber,
                    'payment_date' => $approve_pymt->payment_date,
                    'full_name' => $approve_pymt->full_name,
                ]);
                
                $pay_status = $pay->balance - $approve_pymt->TransAmount > 0 ? 0 : 1;
                $balance = $pay->balance - $approve_pymt->TransAmount;
                $pay->update([
                    'pay_status' => $pay_status,
                    'balance' => $balance,
                    'paid_in' => $pay->paid_in + $approve_pymt->TransAmount,
                    
                ]);
               
                if($pay->landlord_id == null){
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Approve Expense Bill Payment',
                    'more_info' => 'Bill Type: Expense Bill',
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '1',
                    'subscription_id' => '0',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
                }
                else{
                   $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Approve Expense Bill Payment',
                    'more_info' => 'Bill Type: Expense Bill '  . $pay->landlord->full_name,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => $pay->landlord_id,
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'subscription_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]); 
                }
                 return back()->with('success', 'Payment added successfully');   
                }else{
                  return back()->with('error', 'Payment not added successfully');   
                }
            }
                elseif ($pay->bill_type === 'owner_expense') {
            // $pay = PayOwners::where('id', $attributes['landlord_id'])->first();
            if ($pay) {
                 $approve_pymt->update([
                    'status' => $request->approval,
                   
                ]);
                $status = $request->approval;
                if($status == 1){
                $payment = BillsPayment::create([
                    'TransactionType' => $approve_pymt->TransactionType,
                    'MSISDN' => $approve_pymt->MSISDN,
                    'TransID' => $approve_pymt->TransID,
                    'TransAmount' => $approve_pymt->TransAmount,
                    'InvoiceNumber' => $approve_pymt->InvoiceNumber,
                    'payment_date' => $approve_pymt->payment_date,
                    'full_name' => $approve_pymt->full_name,
                ]);
                
                $pay_status = $pay->balance - $approve_pymt->TransAmount > 0 ? 0 : 1;
                $balance = $pay->balance - $approve_pymt->TransAmount;
                $pay->update([
                    'pay_status' => $pay_status,
                    'balance' => $balance,
                    'paid_in' => $pay->paid_in + $approve_pymt->TransAmount,
                    
                ]);
               
                if($pay->landlord_id == null){
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Approve Owner Expense Bill Payment',
                    'more_info' => 'Bill Type: Owner Expense Bill',
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'subscription_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
                }
                else{
                   $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Approve Owner Expense Bill Payment',
                    'more_info' => 'Bill Type: Owner Expense Bill '  . $pay->landlord->full_name,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => $pay->landlord_id,
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'subscription_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]); 
                }
                 return back()->with('success', 'Payment added successfully');   
                }else{
                  return back()->with('error', 'Payment not added successfully');   
                }
            }

            
        }else{
             $pay = PayOwners::where('id', $approve_pymt->MSISDN)->first();
             $approve_pymt->update([
                    'status' => $request->approval,
                   
                ]);
                $status = $request->approval;
                if($status == 1){
                
            $payment = BillsPayment::create([
                
                'TransactionType' => $approve_pymt->TransactionType,
                    'MSISDN' => $approve_pymt->MSISDN,
                    'TransID' => $approve_pymt->TransID,
                    'TransAmount' => $approve_pymt->TransAmount,
                    'InvoiceNumber' => $approve_pymt->InvoiceNumber,
                    'payment_date' => $approve_pymt->payment_date,
                    'full_name' => $approve_pymt->full_name,
            ]);
            
             $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Approved  Bill Payment',
                    'more_info' => 'Bill Type: Project Bill ' . $pay->apartment->name . ' Amount: Ksh.' . $payment->TransAmount,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => $pay->apartment->id,
                    'landlord_id' => '0',
                    'bill_id' => '0',
                    'invoice_id' => '0',
                    'subscription_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
               
            // $payment = ManualPayment::where('MSISDN', '254700088168')->first();
            $landlord_invoices_to_pay =PayOwners::where('apartment_id', $approve_pymt->MSISDN)->get();
            $balance_reached = $this->updateClientInvoices($landlord_invoices_to_pay, $payment->TransAmount);
               
            return back()->with('success', 'Payment authorized successfully');
                }
                else
                {
                    return back()->with('error', 'Payment not authorized to the system ');
                    
                }
           }
        }
        

    }


    
    public function payNow(Request $request)
    {
        $attributes = $request->validate([
            'apartment_id' => 'nullable',
            'bill_category' => 'nullable',
            'reference' => 'required',
            'amount' => 'required',
            'payment_date' =>'required',
            'service_provider' => 'nullable',
            'bill_for' => 'nullable',
            'agency_service_provider' => 'nullable',
            'agency_bill_for' => 'nullable',
            'agency_user' =>'nullable',
            'payment_type' =>'required',
            'bill_id' =>'nullable',
            'id' =>'nullable',
            
        ]);
        if ($attributes['bill_category'] === 'Projects') {
            $pay = PayOwners::where('id', $attributes['bill_id'])->first();
            if ($pay) {
                $payment = BillsPayment::create([
                    'TransactionType' => $attributes['payment_type'],
                    'MSISDN' => $attributes['bill_id'],
                    'TransID' => $attributes['reference'],
                    'TransAmount' => $attributes['amount'],
                    // 'bill_for' => $attributes['agency_bill_for'],
                    // 'service_provider' => $attributes['agency_service_provider'],
                    'InvoiceNumber' => $attributes['reference'],
                    'payment_date' => $attributes['payment_date'],
                    'bill_category' => $attributes['bill_category'],
                ]);
                $pay_status = $pay->balance - $attributes['amount'] > 0 ? 0 : 1;
                $balance = $pay->balance - $attributes['amount'];
                $pay->update([
                    'pay_status' => $pay_status,
                    'balance' => $balance,
                    'paid_in' =>$pay->paid_in + $attributes['amount'],
                    
                ]);
                if($pay->landlord_id == null){
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Approved Expense Bill Payment',
                    'more_info' => 'Bill Type:  Expense Bill',
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'subscription_id' => '0',
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
                }
                else{
                   $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Approve Expense Bill Payment',
                    'more_info' => 'Bill Type: Expense Bill '  . $pay->landlord->full_name,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => $pay->landlord_id,
                    'bill_id' => '1',
                    'subscription_id' => '0',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]); 
                }
                 return back()->with('success', 'Payment added successfully');   }else{
                  return back()->with('error', 'Payment not added successfully');   
                }
        }
                else {
            $pay = PayOwners::where('id', $attributes['bill_id'])->first();
         
            if ($pay) {
                $payment = BillsPayment::create([
                    'TransactionType' => $attributes['payment_type'],
                    'MSISDN' => $attributes['bill_id'],
                    'TransID' => $attributes['reference'],
                    'TransAmount' => $attributes['amount'],
                    // 'bill_for' => $attributes['agency_bill_for'],
                    'service_provider' => $attributes['agency_service_provider'],
                    'InvoiceNumber' => $attributes['reference'],
                    'payment_date' => $attributes['payment_date'],
                    'bill_category' => $attributes['bill_category'],
                ]);
                $pay_status = $pay->balance - $attributes['amount'] > 0 ? 0 : 1;
                $balance = $pay->balance - $attributes['amount'];
                $pay->update([
                    'pay_status' => $pay_status,
                    'balance' => $balance,
                    'paid_in' =>$pay->paid_in + $attributes['amount'],
                    
                ]);
                if($pay->landlord_id == null){
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Expense Bill Payment by Administrator',
                    'more_info' => 'Bill Type: Expense Bill ' ,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '1',
                    'subscription_id' => '0',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]);
                }
                else{
                   $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Expense Bill Payment by Administrator',
                    'more_info' => 'Bill Type: Expense Bill '  . $pay->landlord->full_name,
                     'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => $pay->landlord_id,
                    'bill_id' => '1',
                    'invoice_id' => '0',
                    'subscription_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
                ]); 
                }
            }
            return back()->with('success', 'Payment added successfully');
                }

         
    
        }
        

    
        
  

    

    public function bills()
    {
        $bills = Bills::all();
        // $var = CarbonCarbon::now()->format('M-Y');

        //Auto calculate the remaining balance to be paid
        $this->setBalance($bills);

        $this->billMonth($bills);

    }

    public function billMonth($id)
    {
        $var = CarbonCarbon::now()->format('M-Y');

        $billmonth = Bills::where('id', $id);

        foreach ($billmonth as $bill) {
            Bills::where('id', $bill->id)
                ->update(['bill_month' => $var]);

        }

    }

    public function setBalance($id)
    {
        $var = CarbonCarbon::now()->format('M-Y');

        $balance = Bills::where('id', $id);

        foreach ($balance as $bal) {
            Bills::where('id', $id)
                ->update(['balance' => ($bal->bill_amount - $bal->paid_in)]);

        }

    }
    
    private function updateClientInvoices($client_invoices, $total_amt_for_month_paid)
    {
        $x = 1;
        $balance_wallet = $total_amt_for_month_paid;
        $length = count($client_invoices);

        foreach ($client_invoices as $client_invoice) {

            if ($balance_wallet > 0) {
                $paid_in = $balance_wallet >= $client_invoice->balance ? $client_invoice->balance : $balance_wallet;
                $balance = $balance_wallet >= $client_invoice->balance ? 0 : $client_invoice->balance - $balance_wallet;
                $client_invoice->update([
                    'paid_in' => $client_invoice->paid_in + $paid_in,
                    'balance' => $balance,
                    'pay_status' => ($balance <= 0) ? true : false,
                    // 'payment_method' => 'Cash',
                ]);
                $balance_wallet = $balance_wallet - $paid_in;

                if ($x === $length && $balance_wallet > $client_invoice->balance) {
                    $client_invoice->update([
                        'balance' => $client_invoice->balance - $balance_wallet,
                    ]);
                }
                $x++;
            }

        }
    }

}
