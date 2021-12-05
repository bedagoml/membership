<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Deposit;
use App\Owner_invoices;
use App\Tenant_bill;
use App\Repair;
use App\Subscription;
use App\Events\NewHouseTenant;
use App\Events\VacateHouseTenant;
use App\House;
use App\HouseTenant;
use App\Meeting_invoice;
use App\ServiceRequests;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateHouseTenantRequest;
use App\Http\Requests\CreateMissingInvoicesRequest;
use App\Http\Requests\UpdateHouseTenantRequest;
use App\Http\Requests\DepositRefundRequest;
use App\Http\Requests\TenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use App\Invoice;
use App\User;
use App\Meeting;
use App\Contribution;
use App\HappyHundred;
use App\ManualPayment;
use App\Overpayment;
use App\PlacementFee;
use App\Tenant;
use App\Traits\FileManager;
use App\Traits\NotifyClient;
use App\Traits\UtilTrait;
use Carbon\Carbon;
use DB;
use Hash;
use PDF;
use Illuminate\Http\Request;
use App\Mail\OnClientPayment;

class TenantsController extends Controller
{
    use NotifyClient;
    use UtilTrait;
    use FileManager;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     
    //       public function mails()
    // {
    //     $data =['name'=>'my sub','message'=>'no way','dat-joined'=>'stas'];
    //     \Mail::to('eric@mail.com')->send(
    //                     new OnClientPayment($data)
    //                 );
    //     return view('emails.onClientPayment');
    // }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        $subscription = Subscription::pluck('id', 'category');
        return view('members.register', compact('subscription'));
    }
   
    //subscription fee
    public function subscription_create()
    {

        return view('subscriptions.create');
    }
    public function subscription_store(Request $request)
    {
        try{

        $subscription = new Subscription;
        $var = Carbon::now()->format('M-Y');
        $month = Carbon::parse($request->subscription_date)->format('M-Y');
        $year = Carbon::parse($request->subscription_date)->format('Y');
        $subscription->subscription_date = $request->subscription_date;
        $subscription->subscription_month = $month;
        $subscription->subscription_year = $year;
        $subscription->subscription_created_month = $var;
        $subscription->is_admin = $request->is_admin;
        $subscription->registration_amount = $request->registration_amount;
        $subscription->description = $request->description;
        $subscription->username = auth()->user()->username;
      

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Created Subscription from year ' .  $subscription->subscription_year,
            'more_info' => 'Subscription created has subscription amount: Ksh.  ' . $subscription->registration_amount,
            'tenant_id' =>  '0',
            'subscription_id' => '1',
            'servicerequest_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
        ]);
        $subscription->save();
       
        
        
        return back()->with('success', 'New subscription Membership Category has been added to the system');
    }
    catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'System error defining subscription, A subscription could be existing.');
}
    
            
    }
    public function subscription_show($id)
    {
        $subscription = Subscription::findOrFail($id);
  

        return view('subscriptions.show', compact('subscription'));

    }

    public function subscription_edit($id)
    {
        $subscription = Subscription::findOrFail($id);
        return view('subscriptions.edit', compact('subscription'));
    }

    public function subscription_update(Request $request, $id)
    {
        try{
        $subscription = Subscription::find($id);
      
       
        $subscription->registration_amount = $request->registration_amount;
        $subscription->description = $request->description;
        $subscription->username = auth()->user()->username;
      
        $subscription->save();

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Edited year '.$subscription->subscription_year.' subscription fee',
            'more_info' => 'Edited subscription details to amount: Ksh' . $subscription->amount . ', description: ' . $subscription->description,
            'tenant_id' =>  '0',
            'subscription_id' => '1',
            'servicerequest_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
        ]);

        return back()->with('success', 'Subscription details successfully updated to the system');
        // return redirect()->route('tenant.show', [$tenant])
        //     ->with('success', 'Tenant details has been updated');
    }
    catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'System error defining subscription details, You might have exceeded the amount range or just contact the System Administrator for more information.');
}
    }
    //subscription fee

    public function store(Request $request)
    {
       
        $year = date("Y", strtotime($request->member_date));
        $subscription = Subscription::where('category', $request->membership)->first();
            $date = date("M-Y", strtotime($request->member_date));
            $month = date("M", strtotime($request->member_date));
           

        // $response = $this->generateUserAccountNumber();
        
        // dd($response);
        // $request->validate([
        //     'filenames' => 'nullable',
        //     'filenames.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,PNG,JPG,jpg',
        // ]);
        
       
    
   

//Exclude the parameters from the $request using except() method
//now in your $hobby variable, you will have "art,artitecture,business"

    
        $tenant = new Tenant;
        // $tenant->id = $request->id;
        $tenant->full_name = $request->full_name;
        $tenant->phone = $request->phone;
        $tenant->id_number = $request->id_number;
        $tenant->email = $request->email;
        $tenant->membership = $request->membership;
        $tenant->member_number = $request->member_number;
        $tenant->password = Hash::make($request->password);
        // $tenant->password = Hash::make($this->generateUserPassword());
        $tenant->test_password = $request->password;
        $tenant->subscription_date = $request->member_date;
        $tenant->status = 1;
       
      
      

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Created New Member ' . $tenant->full_name,
            'more_info' => 'New member registered under membership category:  ' . $tenant->category,
            'tenant_id' =>  '200',
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '1',
            'sms_id' => '0',
            'user_id' => '0',
        ]);
        $tenant->save();
    

         //First annual invoice record
        if( $tenant->membership == "Active Member") {
            
         $invoice = new Invoice;
            
         $invoice->tenant_id = $tenant->id;
         $invoice->type = 'First Subscription Invoice';
         $invoice->invoice_number = $this->generateUserAccountNumber();
         if($month == 'Jul'){
            $invoice->amount = $subscription->registration_amount;
         }
         elseif($month == 'Aug'){
            $invoice->amount = $subscription->registration_amount-($subscription->registration_amount/12);
         }
         elseif($month == 'Sep'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*2);
         }
         elseif($month == 'Oct'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*3);
         }
         elseif($month == 'Nov'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*4);
         }
         elseif($month == 'Dec'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*5);
         }
         elseif($month == 'Jan'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*6);
         }
         elseif($month == 'Feb'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*7);
         }
         elseif($month == 'Mar'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*8);
         }
         elseif($month == 'Apr'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*9);
         }
         elseif($month == 'May'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*10);
         }
         elseif($month == 'Jun'){
            $invoice->amount = $subscription->registration_amount-(($subscription->registration_amount/12)*11);
         }
       
         $invoice->rent_month = $date;
         $invoice->subscription_year = $year;
         $invoice->subscription_date = $tenant->subscription_date;
         $total_payable = $invoice->amount;
         $tenant_name = $tenant->full_name;
         $tenant_phone = $tenant->phone;
         $invoice->total_payable = $total_payable;
         $invoice->balance = $total_payable;
         $invoice->description = 'Invoice for subscription year '.$year;
         $invoice->tenant_name = $tenant_name; 
         $invoice->tenant_phone = $tenant_phone;
         $invoice->save();

        }
       
       
       $data =['name'=> $tenant->full_name,'member_email'=> $tenant->email,'member_password'=>$tenant->test_password];
        \Mail::to($tenant->email)->send(
                        new OnClientPayment($data)
                    );
                    
        $member_registered = Tenant::where('id', $invoice->tenant_id)->first();
        
        if( $member_registered){
            $smses = [];
        $sms_object = $this->welcomeMessageFormat([
            // 'phone' => $inv[0]->tenant->phone,
            'tenant' => $member_registered,
            // 'phone' => (int) $member_registered->phone,
             'phone' => (int) 254714264331,
        ]);
        array_push($smses, $sms_object);
        $this->sendMessage($smses);
        }
        
        
        return back()->with('success', 'New member has been added to the system. Login Credentials sent to '.$tenant->email.' & First Subscription Invoice Generated.');
 
    
            
    }
    public function show($id)
    {
        $var = Carbon::now()->format('Y-m-d');
    //    dd($var);
        
        $tenant = Tenant::findorfail($id);
        $tenant['committees'] = collect(json_decode($tenant['committees']))->implode(', ');
        $id=$tenant->id;
        $houzez = HouseTenant::where('tenant_id', $id)->get();
        $houzes = HouseTenant::where('tenant_id', $id)->first();
        $overpayment = 0;
        $invoizzy = Invoice::where('tenant_id', $id)->where('balance','>', 0)->sum('balance');
        $overpayment = Overpayment::where('tenant_id', $id)->value('amount');
        $tenant_payment = ManualPayment::where('InvoiceNumber', $tenant->account_number)->get();
        $deposits = Deposit::where('tenant_id', $id)->get();
        $invoiz = Invoice::where('tenant_id', $id)->where('balance','=<', 0)->get();
        $repairs = Repair::where('tenant_id', $id)->get();
        $tenant_bill = Tenant_bill::where('tenant_id', $id)->get();
        $placements = PlacementFee::where('tenant_id', $id)->get();
        // $meeting_registerd = Meeting::where('tenant_id', $id)->get();
        $subscription = Subscription::select('*')->first();
        $upcoming_events = Meeting::where('meeting_date','>=', $var)->get();
       

        return view('members.show', compact('upcoming_events','invoizzy','tenant','tenant_bill','tenant_payment','invoiz','repairs', 'houzez', 'overpayment', 'deposits', 'placements','subscription'));
        // return view('members.show', compact('tenant','tenant_payment','houzes', 'houzez', 'overpayment', 'deposits', 'placements', 'invoiz', 'repairs', 'tenant_bill'));

    }
  
 
    
    

    
    public function subscription_delete($id)
    {
        try{
        $subscription = Subscription::findOrFail($id);
        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Deleted Subscription Category: ' . $subscription->category,
            'more_info' => 'Subscription Category of the year' . $subscription->subscription_year,
            'tenant_id' =>  '0',
            'servicerequest_id' => '0',
            'subscription_id' => '1',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
        ]);
     
        $subscription->forceDelete();

        return back()->with('success', 'Subscription Category has been permanently deleted from system, if it is a usable year please add a new one before adding a member to that year subscription fee ');
        }
        catch (\Exception $e) {
         DB::rollback();
         return back()->with('error', 'System error deleting subscription Category, please contact the System Administrator.');
}
    

    }
    // meeting registration
    public function meeting_invoice(Request $request, $id )
    {
        // dd($request->tenant_id);
        $meeting = Meeting::findOrFail($id);
        $meeting_invoice = new Meeting_invoice;
        // $tenant->id = $request->id;
        $meeting_invoice->meeting_id = $meeting->id;
        $meeting_invoice->tenant_id = $request->tenant_id;
      
       
      
      

        $this->createLog([
            'username' => Auth()->user->username,
            'operation' => 'Event registered by '. Auth()->user->username. 'for' .$meeting_invoice->tenant->full_name,
            'more_info' => 'Registered for meeting:  ' . $meeting_invoice->meeting->meeting_title,
            'tenant_id' =>  '200',
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '1',
            'sms_id' => '0',
            'user_id' => '1',
        ]);
        $meeting_invoice->save();
        
if($meeting_invoice->meeting->meeting_amount > 0){
        $var = Carbon::now()->format('M-Y');
        $invoice = new Invoice;
            
        $invoice->tenant_id = $meeting_invoice->tenant_id;
        $invoice->type = 'Event Invoice';
        $invoice->invoice_number = $this->generateUserAccountNumber();
        // $invoice->amount = '0.00';
        $invoice->renewal = $meeting_invoice->meeting->meeting_amount;
        
        $invoice->rent_month = $var;
        // $invoice->subscription_year = $year;
        // $invoice->subscription_date = $tenant->subscription_date;
        $total_payable = $invoice->renewal;
        $tenant_name = $meeting_invoice->tenant->full_name;
        $tenant_phone = $meeting_invoice->tenant->phone;
        $invoice->total_payable = $total_payable;
        $invoice->balance = $total_payable;
        $invoice->description = 'Registered for event scheduled for '.$meeting_invoice->meeting->meeting_date. ' at ' .$meeting_invoice->meeting->meeting_date. ' (EAT)';
        $invoice->tenant_name = $tenant_name; 
        $invoice->tenant_phone = $tenant_phone;
        $invoice->save();
      
       
       
       return back()->with('success', 'Registering to event '.$meeting_invoice->meeting->meeting_title.' and invoice generated with payment required');
 } else{
    return back()->with('success', 'Registering to event '.$meeting_invoice->meeting->meeting_title.' the event is free so no invoice is generated.');
 }
    }

    public function deregister(Request $request, $id)
    {
     $tenants=Tenant::where('id', $id)->first();
     if($tenants->register_status == 1){
     $tenants->register_status = 0;
     $tenants->save();
     return back()->with('success', 'Member Successfully Registered');
     
    }else{
        $tenants->register_status = 1;
     $tenants->save();
     return back()->with('success', 'Member Successfully Deregistered');
    }
    }
    public function approve(Request $request, $id)
    {
     $tenants=Tenant::where('id', $id)->first();
      $year = date("Y", strtotime($tenants->subscription_date));
        $subscription = Subscription::where('category', $tenants->membership)->first();
            $date = date("M-Y", strtotime($tenants->subscription_date));
            $month = date("M", strtotime($tenants->subscription_date));
     if($tenants->status == 0){
     $tenants->status = 1;
      $data =['name'=> $tenants->full_name,'member_email'=> $tenants->email,'member_password'=>$tenants->test_password];
        \Mail::to($tenants->email)->send(
                        new OnClientPayment($data)
                    );
     $tenants->save();
      $invoice = new Invoice;
            
         $invoice->tenant_id = $tenants->id;
         $invoice->type = 'First Subscription Invoice';
         $invoice->invoice_number = $this->generateUserAccountNumber();
       
         $invoice->amount = $subscription->registration_amount;
         $invoice->renewal = $subscription->renewal_amount;
         if($tenants->license == 1)
         $invoice->license = $subscription->license_amount;
         else
         $invoice->license = 0;
         $invoice->rent_month = $date;
         $invoice->subscription_year = $year;
         $invoice->subscription_date = $tenants->subscription_date;
         $total_payable = $invoice->amount;
         $tenant_name = $tenants->full_name;
         $tenant_phone = $tenants->phone;
         $invoice->total_payable = $total_payable;
         $invoice->balance = $total_payable;
         $invoice->description = 'Invoice for subscription year '.$year;
         $invoice->tenant_name = $tenant_name; 
         $invoice->tenant_phone = $tenant_phone;
         $invoice->save();
          $member_registered = Tenant::where('id', $invoice->tenant_id)->first();
        
        if( $member_registered){
            $smses = [];
        $sms_object = $this->welcomeMessageFormat([
            // 'phone' => $inv[0]->tenant->phone,
            'tenant' => $member_registered,
            // 'phone' => (int) $member_registered->phone,
             'phone' => (int) 254714264331,
        ]);
        array_push($smses, $sms_object);
        $this->sendMessage($smses);
        }
     return back()->with('success', 'Member Successfully Approved and Email Sent');
     
    }else{
        $tenants->status = 0;
     $tenants->save();
     return back()->with('success', 'Member Successfully updated to pending status');
    }
    }
    public function suspension(Request $request, $id)
    {
     $tenants=Tenant::where('id', $id)->first();
     if($tenants->suspend_status == 1){
     $tenants->suspend_status = 0;
     $tenants->save();
     return back()->with('success', 'Member Successfully Removed from Suspension');
     
    }else{
        $tenants->suspend_status = 1;
     $tenants->save();
     return back()->with('success', 'Member Successfully Suspended');
    }
    }

   public function list() {
        $tenants = House::get();

        foreach ($tenants as $tenant) {
            $all_tenant_invoices = Invoice::where('tenant_id', $tenant->id)->get();
            $all_tenant_payments = ManualPayment::where('InvoiceNumber', $tenant->account_number)->orWhere('MSISDN', $tenant->phone)->get();
            $tenant['oct_payment'] = $all_tenant_payments->filter(function ($item) {
                $date2 = date('m', strtotime($item['created_at']));
                $date1 = date('10');
                $date2year = date('y', strtotime($item['created_at']));
                $date1year = date('20');
                return $date1 === $date2 && $date1year === $date2year;
            })->sum('TransAmount');
            $tenant['nov_payment'] = $all_tenant_payments->filter(function ($item) {
                $date2 = date('m', strtotime($item['created_at']));
                $date1 = date('11');
                $date2year = date('y', strtotime($item['created_at']));
                $date1year = date('20');
                return $date1 === $date2 && $date1year === $date2year;
            })->sum('TransAmount');
            $tenant['dec_payment'] = $all_tenant_payments->filter(function ($item) {
                $date2 = date('m', strtotime($item['created_at']));
                $date1 = date('12');
                $date2year = date('y', strtotime($item['created_at']));
                $date1year = date('20');
                return $date1 === $date2 && $date1year === $date2year;
            })->sum('TransAmount');
            $tenant['jan_payment'] = $all_tenant_payments->filter(function ($item) {
                $date2 = date('m', strtotime($item['created_at']));
                $date1 = date('01');
                return $date1 === $date2;
            })->sum('TransAmount');
            $tenant['feb_payment'] = $all_tenant_payments->filter(function ($item) {
                $date2 = date('m', strtotime($item['created_at']));
                $date1 = date('m');
                return $date1 === $date2;
            })->sum('TransAmount');
            $tenant['total_paid_mpesa'] = $all_tenant_payments->sum('TransAmount');
            $tenant['total_paid_in'] = $all_tenant_invoices->sum('paid_in');
            $tenant['total_payable'] = $all_tenant_invoices->sum('total_payable');
            $tenant['balance'] = $tenant['total_payable'] -$tenant['total_paid_mpesa'] ;
        }
        $data['tenants'] = $tenants;
        $data['date'] = date('d-m-Y');
        $fl_nm = 'Tenant_Summary.pdf';
        // return view('docs.testInvoiceView', );

        return view('members.all', $data);
  
    }
       public function subscription_list() {
       


        return view('subscriptions.list');
  
    }
     public function meeting_list() {
       
       
         $event_list = Meeting::all();
        return view('meeting.list', compact('event_list'));
        
  
    }
    public function meeting_edit($id) {
       
       
         $event = Meeting::where('id', $id)->first();
        return view('meeting.edit', compact('event'));
        
  
    }
    public function meeting_show($id) {
       
       
         $event = Meeting::where('id', $id)->first();
         $events = Meeting_invoice::where('meeting_id', $id)->count();
         $invoices = Invoice::where('meeting_id', $id)->get();
         
        return view('meeting.show', compact('event', 'events', 'invoices'));
        
  
    }

    //contribution
    public function contribution_project() {

       return view('contributions.index');
       
 
   }
   public function contribution_pay() {

    $tenants = Tenant::pluck('id', 'full_name');

    return view('contributions.pay', compact('tenants'));
    

}
public function happy_hundreds_store(Request $request)
   {
       try{
       
       $contribution = new HappyHundred;
       $contribution->tenant_id = $request->tenant_id;
       $contribution->transaction_code = $request->transaction_code;
       $contribution->payment_type = $request->payment_type;
       $contribution->amount = $request->amount;
       $contribution->payment_date = $request->payment_date;
       $contribution->status = 1;

     

       $this->createLog([
           'username' => auth()->user()->username,
           'operation' => 'Paid Happy Hundred ',
           'more_info' => 'Happy Hundred Payment for: ' .  $contribution->tenant->full_name,
           'tenant_id' =>  '1',
           'subscription_id' => '0',
           'servicerequest_id' => '0',
           'house_id' => '0',
           'apartment_id' => '0',
           'landlord_id' => '0',
           'bill_id' => '0',
           'invoice_id' => '0',
           'sms_id' => '0',
           'user_id' => '1',
       ]);
       $contribution->save();
      
       
       
       return back()->with('success', 'New Happy Hundred Payment Successfully Made to the system');
   }
   catch (\Exception $e) {
       DB::rollback();
       return back()->with('error', 'System error paying happy hundred, please contact the System Administrator.');
}
   }
   public function happy_hundreds_edit($id) {
      
    $tenants = Tenant::pluck('id', 'full_name');
    $happy_hundred = HappyHundred::where('id', $id)->first();
   return view('contributions.happy_hundreds_edit', compact('happy_hundred', 'tenants'));
   

}
   public function happy_hundreds_update(Request $request, $id)
   {
       try{
       
       $contribution = HappyHundred::find($id);
       $contribution->tenant_id = $request->tenant_id;
       $contribution->transaction_code = $request->transaction_code;
       $contribution->payment_type = $request->payment_type;
       $contribution->amount = $request->amount;
       $contribution->payment_date = $request->payment_date;
       $contribution->status = 1;
     

       $this->createLog([
           'username' => auth()->user()->username,
           'operation' => 'Edited Happy Hundred Payment ',
           'more_info' => 'Happy Hundred Payment for: ' .  $contribution->tenant->full_name,
           'tenant_id' =>  '0',
           'subscription_id' => '0',
           'servicerequest_id' => '0',
           'house_id' => '0',
           'apartment_id' => '0',
           'landlord_id' => '0',
           'bill_id' => '0',
           'invoice_id' => '0',
           'sms_id' => '0',
           'user_id' => '1',
       ]);
       $contribution->save();
      
       
       
       return back()->with('success', 'Happy Hundred Payment edited successfully to the system');
   }
   catch (\Exception $e) {
       DB::rollback();
       return back()->with('error', 'System error updating the payment, please contact the System Administrator.');
}
   }

   public function happy_hundreds_list() {
       
       
    $projects_list = HappyHundred::all();
   return view('contributions.happy_hundreds_list', compact('projects_list'));
   

}
   
    public function contribution_project_list() {
       
       
        $projects_list = Contribution::all();
       return view('contributions.list', compact('projects_list'));
       
 
   }
   public function contribution_project_edit($id) {
      
      
        $event = Contribution::where('id', $id)->first();
       return view('contributions.edit', compact('event'));
       
 
   }
   public function contribution_project_show($id) {
      
      
        $projects = Contribution::where('id', $id)->first();
        $events = ManualPayment::where('InvoiceNumber', $projects->title)->get();
        $donations = ManualPayment::where('InvoiceNumber', $projects->title)->sum('TransAmount');
        // $invoices = Invoice::where('meeting_id', $id)->get();
        
       return view('contributions.show', compact('projects', 'events','donations'));
       
 
   }
   public function contribution_project_store(Request $request)
   {
       try{
       
       $contribution = new Contribution;
       $contribution->project_date = $request->project_date;
       $contribution->project_title = $request->project_title;
       $contribution->project_description = $request->project_description;
     

       $this->createLog([
           'username' => auth()->user()->username,
           'operation' => 'Created New Project ',
           'more_info' => 'Contribution Deadline: ' .  $contribution->project_date,
           'tenant_id' =>  '0',
           'subscription_id' => '0',
           'servicerequest_id' => '0',
           'house_id' => '0',
           'apartment_id' => '0',
           'landlord_id' => '0',
           'bill_id' => '0',
           'invoice_id' => '0',
           'sms_id' => '0',
           'user_id' => '1',
       ]);
       $contribution->save();
      
       
       
       return back()->with('success', 'New Project has been created to the system');
   }
   catch (\Exception $e) {
       DB::rollback();
       return back()->with('error', 'System error creating the project, please contact the System Administrator.');
}
   
           
   }
   public function contribution_project_update(Request $request, $id)
   {
       try{
       
       $contribution = Contribution::find($id);
       $contribution->project_date = $request->project_date;
       $contribution->project_title = $request->project_title;
       $contribution->project_description = $request->project_description;
     

       $this->createLog([
           'username' => auth()->user()->username,
           'operation' => 'Edited Project ',
           'more_info' => 'Contribution Deadline: ' .  $contribution->project_date,
           'tenant_id' =>  '0',
           'subscription_id' => '0',
           'servicerequest_id' => '0',
           'house_id' => '0',
           'apartment_id' => '0',
           'landlord_id' => '0',
           'bill_id' => '0',
           'invoice_id' => '0',
           'sms_id' => '0',
           'user_id' => '1',
       ]);
       $contribution->save();
      
       
       
       return back()->with('success', 'Project edited successfully to the system');
   }
   catch (\Exception $e) {
       DB::rollback();
       return back()->with('error', 'System error updating the projet, please contact the System Administrator.');
}
   
           
   }
    // public function meeting_list() {
       
       
    //      $events = Meeting_invoice::all();
        
        
    //      foreach ($events as $en){
            
    //         if (Meeting_invoice::where('meeting_id', $en->meeting->id)->exists()) {
    //              return $event = Meeting_invoice::where('meeting_id', $en->meeting->id)->count();
    //           }
    //           else{
    //               return $event = 0;
    //           }
    //          if (Invoice::where('meeting_id', $en->meeting->id)->exists()) {
    //             return $invoice = Invoice::where('meeting_id', $en->meeting->id)->sum('paid_in');
    //           }
    //           else{
    //               return $invoice = 0;
    //           }
               
    //           if (Invoice::where('meeting_id', $en->meeting->id)->exists()) {
    //             return $invoice1 = Invoice::where('meeting_id', $en->meeting->id)->sum('balance');
    //           }
    //           else{
    //               return $invoice1 = 0;
    //           }
          
           
    //      }
    //     return view('meeting.list', compact('events'));
        
  
    // }
    public function attendance_list() {
       

        $events = Meeting_invoice::all();
       return view('meeting.attendance', compact('events'));
 
   }


    public function assignRoom($house_id = null)
    {

        if ($house_id) {

            $house = House::findOrFail($house_id);
            $tenants = Tenant::pluck('id', 'full_name');
            return view('members.assign_vacant_room', compact('house', 'tenants'));
            // return response() -> json([$house, $tenants]);
            // return view('members.assign_vacant_room', compact('house','apartments', 'tenants'));

        } else {
            $apartments = Apartment::pluck('id', 'name');
            $tenants = Tenant::pluck('id', 'full_name');
            return view('members.asign_room', compact('apartments', 'tenants'));
        }

    }
    public function assignRoomedit($house_id)
    {
        
        $house_tenants = HouseTenant::findOrFail($house_id);
         $date = date("M-Y", strtotime($house_tenants->placement_date));
        
        $tenants = Tenant::pluck('id', 'full_name');
        $apartments = Apartment::pluck('id', 'name');
        $placement_fee = PlacementFee::pluck('id', 'tenant_id', 'placement_month');
        $house = House::pluck('id', 'house_no');
        $invoice = Invoice::where('house_id', $house_tenants->house_id)->where('tenant_id', $house_tenants->tenant_id)->where('rent_month', $date)->get();
        return view('members.assign_roomedit', compact('apartments', 'house', 'tenants', 'placement_fee', 'house_tenants','invoice'));
    }
   
  public function missingInvoices(CreateMissingInvoicesRequest $request, $id)
    {
             
             
        $house_tenants = HouseTenant::find($id);
        // $houses = House::with('rent', 'house_tenant')->occupied()->get();
        // DB::beginTransaction();
        // try {
          // $invoices = new Invoice;
           $var = Carbon::now()->format('M-Y');
           $date = Carbon::createFromFormat('Y-m-d', $house_tenants->placement_date)->format('M-Y');
           $date1 = Carbon::createFromFormat('Y-m-d', $house_tenants->placement_date)->addMonthsNoOverflow()->format('M-Y');
           

$dates = [1,2,3,4,5,6,7,8];
//$today = date();
$start_date = date('Y-m-d', strtotime('2020-10-1'));
foreach( $dates as $key => $value ){
    $date_new = date('M-Y',strtotime($start_date . ' +'.$value.' month'));
    //echo $key."\t=>\t".$date_new."\n";
    
    
     $current_month_invoice = Invoice::where('rent_month', $date_new)
                ->where('house_id', $house_tenants->house->id)
                ->where('apartment_id', $house_tenants->house->apartment_id)
                ->where('tenant_id', $house_tenants->tenant->id)->first();
            
   

            if (!$current_month_invoice) {
                $current_month_invoice =  Invoice::create([
                    'rent' => $house_tenants->house->rent->amount,
                    'electricity_bill' => $house_tenants->house->rent->electricity_bill,
                    'water_bill' => $house_tenants->house->rent->water_bill,
                    'litter_bill' => $house_tenants->house->rent->litter_bill,
                    'compound_bill' => $house_tenants->house->rent->compound_bill,
                    'security' => $house_tenants->house->rent->security,
                    'other_bill' => $house_tenants->house->rent->others,
                    'type' => 'Monthly Rent',
                    'rent_month' => $date_new,
                    'house_id' => $house_tenants->house->id,
                    'apartment_id' => $house_tenants->house->apartment_id,
                    'tenant_id' => $house_tenants->tenant_id,
                    'house_name' => $house_tenants->house->house_no,
                    'apartment_name' => $house_tenants->house ->apartment->name,
                    'tenant_name' => $house_tenants->tenant->full_name]
                );
            }


  
        
        //add sms body here

        //DB::commit();
        // $this->storedeposit($request->id, $request->tenant_id);
        //Artisan::call('invoice:initialize');
        // return back()->with('success', 'All invoices have been generated, .');

        //return redirect()->route('invoice.prepare', $invoices)->with('success', 'New Tenant has been assigned a house, proceed to adding bill then generate invoice');

        // } catch (\Exception $e) {
        //     DB::rollback();
        //     Log::info($e);
        //     return back()->with('error', 'Internal Error occured during this process.Contact Admin for more info');

        // }
        
        //  $monthly_bills = MonthlyBilling::selectRaw('SUM(billing_amount) as sum_bills,house_id')
        //     ->where('billing_month', $date1)
        //     ->groupBy('house_id')
        //     ->get();

        // foreach ($monthly_bills as $bill) {
        //     Invoice::where('house_id', $bill->house_id)
        //         ->where('rent_month', $date1)
        //         ->update(['bills' => $bill->sum_bills]);
        // }

        //Query to compute carry overs from previous month
        // $this->generateCarryForwards($x);

        //Query to compute overpayments from previous month
        $overpayments = Invoice::where('rent_month','<', $date_new)->where('balance', '<', 0)->get();

        foreach ($overpayments as $overpayment) {
            Invoice::where('house_id', $overpayment->house_id)
                ->where('tenant_id', $overpayment->tenant_id)
                ->where('rent_month', $date_new)
                ->update(['paid_in' => $overpayment->balance*-1]);

        }
        $balance = Invoice::where('rent_month', '<', $date_new)->where('balance', '<', 0)->get();

        foreach ($balance as $overpayment) {
            Invoice::where('house_id', $overpayment->house_id)
                ->where('rent_month', '<', $date_new)
                ->where('tenant_id', $overpayment->tenant_id)
                ->update(['balance' => ($overpayment->balance - $overpayment->balance)]);

        }
       
        // $this->generateOtherBill($x);
        
        
        
        // $this->generateElectricityBill($var);
        
        // $this->generateCompoundBill($var);
        
        // $this->generateLitterBill($var);
        
        //Autofill Total Payable
         $invoices = Invoice::where('rent_month', $date_new)->get();

        foreach ($invoices as $invoice) {
            Invoice::where('house_id', $invoice->house_id)
                ->where('tenant_id', $invoice->tenant_id)
                ->where('rent_month', $date_new)
                ->update(['total_payable' => ($invoice->rent + $invoice->electricity_bill + $invoice->compound_bill + $invoice->litter_bill + $invoice->other_bill + $invoice->deposit_paid)]);

        }
         $invoices = Invoice::where('rent_month', $date_new)->get();

        foreach ($invoices as $invoice) {
            Invoice::where('house_id', $invoice->house_id)
                ->where('tenant_id', $invoice->tenant_id)
                ->where('rent_month', $date_new)
                ->update(['balance' => ($invoice->total_payable - $invoice->paid_in)]);

        }

         
        //Auto calculate the remaining balance to be paid
      
        
        //Bulk mark invoices as paid,update Overpayment
        $invoices = Invoice::where('rent_month', $date_new)->where('balance', '<=', 0)->get();

        foreach ($invoices as $invoice) {
            Invoice::where('house_id', $invoice->house_id)
                ->where('tenant_id', $invoice->tenant_id)
                ->where('rent_month', $date_new)
                ->update(['is_paid' => 1,
                    'payment_method' => 'Reconciled']);

        }
}
            return back()->with('success', 'Tenant invoices '.$date_new.' have been generated');
    }

    public function allocateHouse(CreateHouseTenantRequest $request)
    {
        //dd($request->placement_date);

        // DB::beginTransaction();
        // try {
          // $invoices = new Invoice;
           $var = Carbon::now()->format('M-Y');
           //$date = Carbon::parse($request->placement_date)->format('M-Y');
            // // Associate Tenant with Vacant Room
            $house_tenant = new HouseTenant;
            $house_tenant->house_id = $request->house_id;
            $house_tenant->tenant_id = $request->tenant_id;
            $house_tenant->placement_date = $request->placement_date;
            $house_tenant->save();
           

            //Record the deposit tenant pays

            if ($request->deposit_amount > 0) {
                $deposit = new Deposit;$request->tenant_id;
                $deposit->house_id = $request->house_id;
                $deposit->tenant_id = $request->tenant_id;
                $deposit->amount = $request->deposit_amount;
                $deposit->apartment_id = $request->apartment;
                $deposit->start_month = $var;
                $deposit->save();
            }

            //First rent is recorded as placement fee
            $date = date("M-Y", strtotime($request->placement_date));
           // return response()->json($request->placement_date);
            $placement_fee = new PlacementFee;
            $placement_fee->tenant_id = $request->tenant_id;
            $placement_fee->house_id = $request->house_id;
            $placement_fee->amount = $request->rent_amount;
            $placement_fee->apartment_id = $request->apartment;
            $placement_fee->placement_month = $date;
            $placement_fee->save();
            //First rent and deposit invoice record
            
            
            $invoice = new Invoice;
            
            
            $invoice->tenant_id = $request->tenant_id;
            $invoice->type = 'rent and deposit';
            $invoice->rent = $request->rent;
            // $invoice->deposit = $request->rent;
            $invoice->placementfee = $request->rent * 0.1;
            $invoice->carryforward  = $request->arrears;
            $invoice->deposit_paid = $request->deposit_amount;
            $invoice->electricity_deposit_paid = $request->electricity_deposit_amount;
            $invoice->electricity_bill  = $request->electricity_bill;
            $invoice->water_bill  = $request->water_bill;
            $invoice->compound_bill  = $request->compound_bill;
            $invoice->litter_bill  = $request->litter_bill; 
            $invoice->security  = $request->security;
            $invoice->other_bill  = $request->other_bill;
            $invoice->house_id = $request->house_id;
            
            $invoice->apartment_id = $request->apartment;
            $invoice->rent_month = $date;
            $total_payable = $invoice->rent + $invoice->deposit_paid + $invoice->carryforward + $invoice->electricity_deposit_paid + $invoice->security + $invoice->electricity_bill + $invoice->water_bill + $invoice->compound_bill + $invoice->litter_bill + $invoice->other_bill;
            
            $house_name = $invoice->house->house_no;
            $tenant_name = $invoice->tenant->full_name;
            $apartment_name = $invoice->apartment->name;
            $invoice->total_payable = $total_payable;
            $invoice->balance = $total_payable;
            $invoice->house_name = $house_name; 
            $invoice->tenant_name = $tenant_name; 
            $invoice->apartment_name = $apartment_name; 
            $invoice->save();

        // Trigger event to make house as occupied
        event(new NewHouseTenant($house_tenant->house_id));
        
        //add sms body here
    
        //DB::commit();
        // $this->storedeposit($request->id, $request->tenant_id);
        //Artisan::call('invoice:initialize');
        $tenant_being_placed = Tenant::where('id', $request->tenant_id)->first();
        
        if( $tenant_being_placed){
            $smses = [];
        $sms_object = $this->welcomeMessageFormat([
            // 'phone' => $inv[0]->tenant->phone,
            'tenant' => $tenant_being_placed,
            'phone' => (int) $tenant_being_placed->phone,
        ]);
        array_push($smses, $sms_object);
        $this->sendMessage($smses);
        }
        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Assigned Tenant House ' . $house_name . ' in ' . $invoice->apartment->name,
            'more_info' => 'Tenant assigned house is:  ' . $tenant_name,
            'tenant_id' =>  $invoice->tenant_id,
            'invoice_id' =>  $invoice->id,
            'house_id' =>  $invoice->house_id,
            'apartment_id' => $invoice->apartment_id,
            'landlord_id' => $invoice->apartment->landlord_id,
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'bill_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
        ]);
        return back()->with('success', 'New tenant has been assigned a house and invoice generated, .');

        //return redirect()->route('invoice.prepare', $invoices)->with('success', 'New Tenant has been assigned a house, proceed to adding bill then generate invoice');

        // } catch (\Exception $e) {
        //     DB::rollback();
        //     Log::info($e);
        //     return back()->with('error', 'Internal Error occured during this process.Contact Admin for more info');

        // }

    }
    public function updateallocateHouse(UpdateHouseTenantRequest $request, $id)
    {   
        
         $house_tenants = HouseTenant::find($id);
         $date1 = date("M-Y", strtotime($request->placement_date));
        
        $invoices = Invoice::where('house_id', $house_tenants->house_id)->where('rent_month', $date1)->delete();
        $house_tenant = HouseTenant::where('house_id', $house_tenants->house_id)->delete();
            //fire event to make house as Vacant
            event(new VacateHouseTenant($house_tenants->house_id));
            DB::commit();
        
        
        $house_tenant = new HouseTenant;
        $house_tenant->house_id = $request->house_id;
        $house_tenant->tenant_id = $request->tenant_id;
        $house_tenant->placement_date = $request->placement_date;
        $house_tenant->save();
        
        $invoice = new Invoice;
            
            $date = date("M-Y", strtotime($request->placement_date));
            $invoice->tenant_id = $request->tenant_id;
            $invoice->type = 'rent and deposit';
            $invoice->rent = $request->rent;
            // $invoice->deposit = $request->rent;
            $invoice->placementfee = $request->rent * 0.1;
            $invoice->carryforward  = $request->arrears;
            $invoice->deposit_paid = $request->deposit_amount;
            $invoice->electricity_deposit_paid = $request->electricity_deposit_amount;
            $invoice->electricity_bill  = $request->electricity_bill;
            $invoice->water_bill  = $request->water_bill;
            $invoice->compound_bill  = $request->compound_bill;
            $invoice->litter_bill  = $request->litter_bill; 
            $invoice->other_bill  = $request->other_bill;
            $invoice->house_id = $request->house_id;
            
            $invoice->apartment_id = $request->apartment;
            $invoice->rent_month = $date;
            $total_payable = $invoice->rent + $invoice->deposit_paid + $invoice->carryforward + $invoice->electricity_deposit_paid + $invoice->electricity_bill + $invoice->water_bill + $invoice->compound_bill + $invoice->litter_bill + $invoice->other_bill;
            
            $house_name = $invoice->house->house_no;
            $tenant_name = $invoice->tenant->full_name;
            $apartment_name = $invoice->apartment->name;
            $invoice->total_payable = $total_payable;
            $invoice->balance = $total_payable;
            $invoice->house_name = $house_name; 
            $invoice->tenant_name = $tenant_name; 
            $invoice->apartment_name = $apartment_name; 
            $invoice->save();
            
            
        // Trigger event to make house as occupied
        event(new NewHouseTenant($house_tenant->house_id));
       

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Tenant Reassigned' . $house_tenant->tenant->full_name,
            'more_info' => 'Tenant Account Number ' . $house_tenant->tenant->account_number,
             'tenant_id' =>  $invoice->tenant_id,
            'invoice_id' =>  $invoice->id,
            'house_id' =>  $invoice->house_id,
            'apartment_id' => $invoice->apartment_id,
            'landlord_id' => $invoice->apartment->landlord_id,
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'bill_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
        ]);

        return redirect()->route('house.occupied')
            ->with('success', 'Tenant has been reassigned and a new invoice is generated');

    }

    

    public function showPasswordForm($id)
    {
        $tenants = Tenant::findorfail($id);
        return view('members.change_pass', compact('tenants'))->with('tenant_id', $id);
    }


    public function meeting()
    {
        return view('meeting.index');
    }
    
    
    
    public function meeting_store(Request $request)
    {
        try{
        
        $meeting = new Meeting;
        $meeting->meeting_date = $request->meeting_date;
        $meeting->meeting_time = $request->meeting_time;
        $meeting->meeting_title = $request->meeting_title;
        $meeting->meeting_amount = $request->meeting_amount;
        $meeting->meeting_description = $request->meeting_description;
      

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Created New Event ',
            'more_info' => 'When: ' .  $meeting->meeting_date,
            'tenant_id' =>  '0',
            'subscription_id' => '0',
            'servicerequest_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '1',
        ]);
        $meeting->save();
       
        
        
        return back()->with('success', 'New Event has been created to the system');
    }
    catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'System error creating the event, please contact the System Administrator.');
}
    
            
    }
    public function meeting_update(Request $request, $id)
    {
        try{
        
        $meeting = Meeting::find($id);
        $meeting->meeting_date = $request->meeting_date;
        $meeting->meeting_time = $request->meeting_time;
        $meeting->meeting_title = $request->meeting_title;
        $meeting->meeting_amount = $request->meeting_amount;
        $meeting->meeting_description = $request->meeting_description;
      

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Edited Event ',
            'more_info' => 'When: ' .  $meeting->meeting_date,
            'tenant_id' =>  '0',
            'subscription_id' => '0',
            'servicerequest_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '1',
        ]);
        $meeting->save();
       
        
        
        return back()->with('success', 'Event edited successfully to the system');
    }
    catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'System error updating the event, please contact the System Administrator.');
}
    
            
    }
   


    public function updatePassword(ChangePasswordRequest $request, $id)
    {
        $tenant = Tenant::find($id);
        $tenant->password = Hash::make($request->new_password);
        $tenant->save();

        return redirect()->route('tenant.show', [$tenant])
            ->with('success', 'Tenant password has been reset.');

    }

    public function vacateHouse($house_id)
    {

        DB::beginTransaction();
          try{
            $house_tenant = HouseTenant::where('house_id', $house_id)->first();
            //fire event to make house as Vacant
             $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Tenant vacated from house ' . $house_tenant->house->house_no. ' in ' . $house_tenant->house->apartment->name ,
            'more_info' => 'Tenant vacated is:  ' . $house_tenant->tenant->full_name,
            'tenant_id' =>  $house_tenant->tenant_id,
            'house_id' =>  $house_tenant->house_id,
            'apartment_id' => $house_tenant->house->apartment_id,
            'landlord_id' => $house_tenant->house->apartment->landlord_id,
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
        ]);
        $house_tenant->delete();
            event(new VacateHouseTenant($house_id));
           
            DB::commit();
            return redirect()->back()->with('success', 'Tenant has been vacated from the house');
          }
         catch (\Exception $e) {
         DB::rollback();
         return back()->with('error', 'System error Vacating Tenant, please contact the System Administrator.');
      }
         
    }
    private function dateFormater($date_format, $date, $converted_format)
    {
        return \DateTime::createFromFormat($date_format, $date)->format($converted_format);
    }
    
    private function welcomeMessageFormat($notificationBody)
    {
        $userData = (object) $notificationBody;
        $account_number = $userData->tenant->member_number;

        // $amount = $userData->to_pay;

        $tenant_full_name = $userData->tenant->full_name;
        $arr_names = explode(' ', trim(ucfirst(strtolower($tenant_full_name))));
        $tenant_first_name = $arr_names[0]; // will print Test

        $format = "Dear %s,\nWelcome to Membership Management System.\nYour member number is %d:\nMake all payments following instructions on your specific invoice via Mpesa using: \nPaybill: 4080833 \nAccount: (Invoice Number)";
        $message_text = sprintf($format, $tenant_first_name, $account_number);

        $message_text .= "\nFor enquiries call 0718095463.";

        $data = [
            'from' => 'Ecyber Tech',
            'to' => (int) $userData->phone,
            'text' => $message_text,
        ];

        return $data;

    }

}
