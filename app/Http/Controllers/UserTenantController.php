<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\HouseTenant;
use App\Overpayment;
use App\PlacementFee;
use App\ManualPayment;
use App\Invoice;
use App\Repair;
use App\Subscription;
use App\Tenant;
use App\HappyHundred;
use App\Tenant_bill;
use App\Traits\FileManager;
use App\Traits\NotifyClient;
use App\Traits\UtilTrait;
use Carbon\Carbon;
use DB;
use Hash;
use PDF;
use App\Http\Requests\UpdateTenantRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Meeting;
use App\Meeting_invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTenantController extends Controller
{
    use NotifyClient;
    use UtilTrait;
    use FileManager;

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:tenant');
    }


    public function index()
    {
        
        $var = Carbon::now()->format('Y-m-d');
    //    dd($var);
        
        $tenant = Auth::guard('tenant')->user();
        $id=$tenant->id;
        $houzez = HouseTenant::where('tenant_id', $id)->get();
        $houzes = HouseTenant::where('tenant_id', $id)->first();
        $overpayment = 0;
        $overpayment = Overpayment::where('tenant_id', $id)->value('amount');
        $tenant_payment = ManualPayment::where('InvoiceNumber', $tenant->account_number)->get();
        $deposits = Deposit::where('tenant_id', $id)->get();
        $invoiz = Invoice::where('tenant_id', $id)->where('balance','=<', 0)->get();
        $invoizzy = Invoice::where('tenant_id', $id)->where('balance','>', 0)->sum('balance');
        $repairs = Repair::where('tenant_id', $id)->get();
        $tenant_bill = Tenant_bill::where('tenant_id', $id)->get();
        $placements = PlacementFee::where('tenant_id', $id)->get();
        // $meeting_registerd = Meeting::where('tenant_id', $id)->get();
        $subscription = Subscription::select('*')->first();
        $upcoming_events = Meeting::where('meeting_date','>=', $var)->get();
       

        return view('users.member.index', compact('upcoming_events','invoizzy','tenant','tenant_bill','tenant_payment','invoiz','repairs', 'houzez', 'overpayment', 'deposits', 'placements','subscription'));
    }
    public function edit($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('users.member.edt', compact('tenant'));
    }
    public function attend_meeting()
    {
        $var = Carbon::now()->format('Y-M-D');
        $meeting = Meeting::where('meeting_date', $var)->get();
        return view('users.member.attendance', compact('meeting'));
    }
    public function instruction()
    {
        
        return view('users.member.instruction');
    }
    public function meeting_invoice(Request $request, $id )
    {
        // dd($request->tenant_id);
        $meeting = Meeting::findOrFail($id);
        $meeting_invoice = new Meeting_invoice;
        // $tenant->id = $request->id;
        $meeting_invoice->meeting_id = $meeting->id;
        $meeting_invoice->tenant_id = $request->tenant_id;
      
       
      
      

        $this->createLog([
            'username' => Auth::guard('tenant')->user()->email,
            'operation' => 'Event registered by '. $meeting_invoice->tenant->full_name,
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
            'user_id' => '0',
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

    public function update(UpdateTenantRequest $request, $id)
    {
        $tenant = Tenant::find($id);
        $tenant->phone = $request->phone;
        $tenant->email = $request->email;
        
        $tenant->save();

        $this->createLog([
            'username' => Auth::guard('tenant')->user()->email,
            'operation' => 'Edited Member ' . $tenant->full_name,
            'more_info' => 'Member Account Number ' . $tenant->account_number,
            'tenant_id' =>  $tenant->id,
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
        ]);

        return redirect()->route('tenant-home', [$tenant])
            ->with('success', 'Your have successfully updated your details');

    }
    public function showPasswordForm($id)
    {
        $tenant = Tenant::findorfail($id);
        return view('users.member.change_pass',  compact('tenant'))->with('tenant_id', $id);
    }
    public function updatePassword(ChangePasswordRequest $request, $id)
    {
        $tenant = Tenant::find($id);
        $tenant->password = Hash::make($request->new_password);
        $tenant->save();

        return redirect()->route('tenant-home', [$tenant])
            ->with('success', 'Your password has been reset.');

    }
    public function showInvoice($id, $action = null)
    {
        $invoice = Invoice::with('tenant')->findOrFail($id);


        switch ($action) {
            case 'print':
                return view('users.member.invoiceprint', compact('invoice'));
            // case 'message':
            //     $current_invoice = Invoice::with('tenant')->where('id',$id)->first();
                
            // $smses = [];
            // $sms_object = $this->invoiceMessageFormat([
                // 'phone' => $inv[0]->tenant->phone,
        //         'tenant' => $current_invoice->tenant,
        //         'to_pay' =>  $current_invoice->balance,
        //         'phone' => (int) $current_invoice->tenant->phone,
        //     ]);
        // array_push($smses, $sms_object);
        // $this->sendMessage($smses);
        //         return back()->with('success', 'Message sent successfully'); 
            case 'pdf':
                // return view('invoices.invoicepdf', compact('invoice', 'billings', 'overpayment'));

                $pdf = PDF::loadView('users.member.invoicepf', compact('invoice'));
                return $pdf->stream('Invoice #' . $id . '.pdf');
            default:
                return view('users.member.invoice', compact('invoice'));
                break;
        }

    }

   
    function list() {
        $tenant = Auth::guard('tenant')->user();
        $id=$tenant->id;
        $invoices = Invoice::where('tenant_id',$id)->get();
        return view('users.member.list', compact('invoices'));
    }

    public function meeting_list() {
       

        $events = Meeting::all();
       return view('users.member.events', compact('events'));
 
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
       $contribution->status = 2;

     

       $this->createLog([
           'username' => Auth::guard('tenant')->user()->email,
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
       $contribution->status = 2;
     

       $this->createLog([
           'username' => Auth::guard('tenant')->user()->email,
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
       
    $tenant = Auth::guard('tenant')->user();   
    $projects_list = HappyHundred::where('id', $tenant->id);
   return view('contributions.happy_hundreds_list', compact('projects_list'));
   

}
}
