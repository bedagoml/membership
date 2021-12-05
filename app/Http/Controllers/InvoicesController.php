<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Receipt;
use App\House;
use App\Http\Requests\CreateMonthlyBillingRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\ManualPayment;
use App\ManagerPayment;
use App\MonthlyBilling;
use App\Overpayment;
use App\Tenant;
use App\Traits\NotifyClient;
use App\Traits\UtilTrait;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use PDF;

class InvoicesController extends Controller
{
    use NotifyClient;
    use UtilTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function prepare()
    {
        $apartments = Apartment::pluck('id', 'name');
        return view('invoices.prepare', compact('apartments'));
    }

    public function storeMonthlyBilling(CreateMonthlyBillingRequest $request)
    {

        if ($request->filled('bill_name')) {
            for ($i = 0; $i < count($request->bill_name); $i++) {
                $monthly_bill = new MonthlyBilling;
                $monthly_bill->billing_name = $request->bill_name[$i];
                $monthly_bill->billing_amount = $request->bill_amount[$i];
                $monthly_bill->billing_month = $request->bill_month . '-' . $request->bill_year;
                $monthly_bill->house_id = $request->house_id;

                $monthly_bill->save();
            }
            return back()->with('success', 'Monthly bills have been scheduled for invoice generation');

        } else {
            return back()->with('success', 'No Bills Were Added');

        }

    }

    public function deleteMonthlyBill(Request $request)
    {
        if ($request->ajax()) {
            MonthlyBilling::destroy($request->id);
        }

    }

    public function initializeInvoice($var)
    {
        //Initialize array that will be populated by all billable houses
        $billables = [];
        //Query to get house with corresponding monthly rent
        $houses = House::with('rent', 'house_tenant')->occupied()->get();
        // $test_array = [];
        //Iterate the collection,extracting each individual house with data and appending to array
        foreach ($houses as $house) {
            $current_month_invoice = Invoice::where('rent_month', $var)
                ->where('house_id', $house->id)
                ->where('apartment_id', $house->apartment_id)
                ->where('tenant_id', $house->house_tenant->tenant_id)->first();

            $is_paid_variable = $current_month_invoice && $current_month_invoice->is_paid == 1 ? 1 : 0;

            Invoice::create([
                'rent' => $house->rent->amount,
                'rent_month' => $var,
                'house_id' => $house->id,
                'apartment_id' => $house->apartment_id,
                'tenant_id' => $house->house_tenant->tenant_id,
                'is_paid' => $is_paid_variable]
            );
        }
        $monthly_bills = MonthlyBilling::selectRaw('SUM(billing_amount) as sum_bills,house_id')->where('billing_month', $var)
            ->groupBy('house_id')
            ->get();

        foreach ($monthly_bills as $bill) {
            Invoice::where('house_id', $bill->house_id)
                ->where('rent_month', $var)
                ->update(['bills' => $bill->sum_bills]);
        }

        

        return "Invoice Created.";

    }

    public function listAll()
    {
        return view('invoices.list');
    }
    
    

    public function showForSpecificMonth($month)
    {
        return view('invoices.monthly')->with('month', $month);
    }

    public function incurPenaltyCharges($var)
    {
        $defaulters = Invoice::unpaid()->where('rent_month', $var)->get();

        foreach ($defaulters as $defaulter) {
            $defaulter->update(['penalty_fee' => (($defaulter->rent + $defaulter->bills) * 0.15)]);
        }

        return " Penalty charged";
    }

    public function listUnpaid()
    {
        return view('invoices.unpaid');
    }
    public function listpaid()
    {
        return view('invoices.paid');
    }
     public function edit($id)
    {
        
        $invoice = Invoice::findOrFail($id);
       $houses = House::pluck('id', 'house_no');
        $apartments = Apartment::pluck('id', 'name');
        $tenants = Tenant::pluck('id', 'full_name');
        
        return view('invoices.edit', compact('invoice','apartments', 'tenants', 'houses'));
    }
    public function update(UpdateInvoiceRequest $request, $id)
    {
        $tenant = Invoice::find($id);
        if($tenant->type == "First Subscription Invoice" ){
            $tenant->amount = $request->amount;
        }
        else{
            $tenant->renewal = $request->renewal;
        }
        $tenant->license = $request->license;
        if($tenant->type == "First Subscription Invoice" ){
            $totalpayable = $tenant->amount + $tenant->license;
        }
        else{
            $totalpayable = $tenant->renewal + $tenant->license; 
        }
        
        
        $tenant->total_payable = $totalpayable;
        $tenant->balance = $totalpayable - $tenant->paid_in;
        if($tenant->balance > 0){
            $tenant->is_paid = '0';
        }else{
            $tenant->is_paid = '1';
        }
        $tenant->description = $request->description;
        $tenant->save();


       

        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Edited Invoice ' . $tenant->tenant->full_name,
            'more_info' => 'Member Account Number ' . $tenant->tenant->member_number,
            'servicerequest_id' => '0',
            'tenant_id' => $tenant->tenant_id,
            'subscription_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => $tenant->id,
            'sms_id' => '0',
            'user_id' => '0',
        ]);

     return back()->with('success', 'Invoice has been edited');

    }

    public function payInvoice(Request $request)
    {
        $invoice = Invoice::find($id);

        $bills = MonthlyBilling::where('billing_month', $invoice->rent_month)->where('house_id', $invoice->house_id)->get();

        $overpayment = 0;

        $temp_overpayment = Overpayment::where('tenant_id', $invoice->tenant_id)->value('amount');

        if ($temp_overpayment) {
            $overpayment = $temp_overpayment;
        }

        return view('invoices.pay', compact(['invoice', 'bills', 'overpayment']));
    }
    public function payInvoiceNow(Request $request)
    {   
        $attributes = $request->validate([
            'type' => 'required',
            'tenant_id' => 'required',
            'payment_type' => 'required',
            'reference' => 'required',
            'amount' => 'required',
            'payment_date' => 'required',
        ]);
        
        $pymt = ManagerPayment::where('TransID', $attributes['reference'])->first();

        if ($pymt) {
            return back()->with('error', 'Payment with transaction code ' . $attributes['reference'] . ' has already been added');
        }
        if ($attributes['type'] === 'Member Invoice') {
            $inv = Invoice::where('id', $attributes['tenant_id'])->first();
            $tenant = Tenant::where('id', $inv->tenant_id)->first();
            if (!$tenant) {
                return back()->with('error', 'Member not found');
            }
            if ($inv) {
                $payment = ManagerPayment::create([
                    'TransactionType' => $attributes['payment_type'],
                    'MSISDN' => $tenant->phone,
                    'TransID' => $attributes['reference'],
                    'TransAmount' => $attributes['amount'],
                    'InvoiceNumber' => 'INV00'. $inv->id,
                    'full_name' => $tenant->full_name,
                    'payment_date' => $attributes['payment_date'],
                    'Manager' => auth()->user()->username,
                    'tenant_id' => $tenant->id,
                    'invoice_type' => $attributes['type'],
                ]);
               
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Member Invoice Manual Payment made by office Manager',
                    'more_info' => 'Invoice Type: Member Invoice | Member: '. $tenant->full_name,
                    'servicerequest_id' => '0',
                    'tenant_id' => '1',
                    'house_id' => '0',
                    'subscription_id' => '1',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '0',
                    'invoice_id' => '1',
                    'sms_id' => '0',
                    'user_id' => '1',
                    
                ]);
            }

            return back()->with('success', 'Payment added successfully awaiting approval');
        }
     
    }
    public function payInvoiceNowupdate(UpdateInvoiceRequest $request, $id)
   {
       $approve_pymt = ManagerPayment::find($id);
      
        $tenant = Tenant::where('id', $approve_pymt->tenant_id)->first();
        $pymt = ManualPayment::where('TransID', $approve_pymt->TransID)->first();
        

        if ($pymt) {
            return back()->with('error', 'Payment with transaction code ' . $approve_pymt->TransID . ' has already been added');
        }
        if ($approve_pymt->invoice_type === 'Member Invoice') {
            $inv = Invoice::where('tenant_id', $approve_pymt->tenant_id)->first();
            $tenant = Tenant::where('id', $approve_pymt->tenant_id)->first();
            
            if (!$tenant) {
                return back()->with('error', 'Error in the payment posted');
            }
            if ($inv) {
                $payment = ManualPayment::create([
                    'TransactionType' => $approve_pymt->TransactionType,
                    'MSISDN' => $approve_pymt->MSISDN,
                    'TransID' => $approve_pymt->TransID,
                    'TransAmount' => $approve_pymt->TransAmount,
                    'InvoiceNumber' => $approve_pymt->InvoiceNumber,
                    'payment_date' => $approve_pymt->payment_date,
                    'full_name' => $approve_pymt->full_name,
                ]);
                if($request->approval == 1){
                $is_paid = $inv->balance - $approve_pymt->TransAmount > 0 ? 0 : 1;
                $balance = $inv->balance - $approve_pymt->TransAmount;
                $inv->update([
                    'is_paid' => $is_paid,
                    'balance' => $balance,
                    'paid_in' => $approve_pymt->TransAmount,
                ]);
                $approve_pymt->update([
                    'status' => $request->approval,
                   
                ]);
                $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Member Invoice Manual Payment Approval',
                    'more_info' => 'Invoice Type: Member Invoice ',
                    'tenant_id' => '1',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'subscription_id' => '1',
                    'landlord_id' => '0',
                    'bill_id' => '0',
                    'invoice_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '1',
                    'servicerequest_id' => '0',
                ]);   }
                elseif($request->approval == 2){
                   $this->createLog([
                    'username' => auth()->user()->username,
                    'operation' => 'Mmeber Invoice Manual Payment Rejected ',
                    'more_info' => 'Invoice Type: Member Invoice ',
                    'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'subscription_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '0',
                    'invoice_id' => '1',
                    'sms_id' => '0',
                    'user_id' => '1',
                    'servicerequest_id' => '0',
                ]); 
                }
               
            }
            
        $sms_to_send = [];
        $sms_to_send_admin = [];
        $tenant_full_name = $tenant->full_name;
        $arr_names = explode(' ', trim(ucfirst(strtolower($tenant_full_name))));
        $tenant_first_name = $arr_names[0];
        $tenant_last_name_n_first = $tenant_first_name === end($arr_names) ? $tenant_first_name : $tenant_first_name . ' ' . end($arr_names);

        array_push($sms_to_send, $this->paymentConfirmationSmsFormat([
            'name' => $tenant_first_name,
            'amt_paid' => $payment->TransAmount,
            'prepayment' => $inv->prepayment,
            'balance' => $inv->balance,
            'amount' => $inv->renewal,
            'acc_num' => $inv->invoice_number,
            // 'phone' => (int) $tenant->phone,
            'phone' => (int) '254714264331',
        ]));
        array_push($sms_to_send_admin, $this->paymentConfirmationSmsFormatAdmin([
            'name' => $tenant_last_name_n_first,
            'amt_paid' => $payment->TransAmount,
            'prepayment' => $inv->prepayment,
            'balance' => $balance,
            'transaction_code' => $payment->TransID,
            'account_number' => $tenant->member_number,
            'amount' => $inv->renewal,
            // 'phone' => (int) $tenant->phone,
            'phone' => (int) '254714264331',
        ]));
         // return response()->json([$sms_to_send, $sms_to_send_admin]);
        //  $this->sendMessage($sms_to_send);
        // $this->sendMessage($sms_to_send_admin);

        return redirect()->route('manualinvoice.payments')
        ->with('success', 'Payment authorization has been recorded'); 
        }
       

}
        
       

       
        
                    
       
        

     public function payInvoiceNowadmin(Request $request)
    {   
        $attributes = $request->validate([
            'type' => 'required',
            'tenant_id' => 'required',
            'payment_type' => 'required',
            'reference' => 'required',
            'amount' => 'required',
            'payment_date' => 'required',
        ]);
        // $tenant = Tenant::where('id', $attributes['tenant_id'])->first();
        $pymt = ManualPayment::where('TransID', $attributes['reference'])->first();
       

        if ($pymt) {
            return back()->with('error', 'Payment with transaction code ' . $attributes['reference'] . ' has already been added');
        }
        if ($attributes['type'] === 'Member Invoice') {
            $inv = Invoice::where('id', $attributes['tenant_id'])->where('balance','!=', 0)->first();
            $tenant = Tenant::where('id', $inv->tenant_id)->first();
            
            if (!$inv) {
                return back()->with('error', 'No Unpaid Invoice Found');
            }
            if ($inv) {
                $payment = ManualPayment::create([
                    'TransactionType' => $attributes['payment_type'],
                    'MSISDN' => $inv->tenant_phone,
                    'TransID' => $attributes['reference'],
                    'TransAmount' => $attributes['amount'],
                    'InvoiceNumber' => 'INV00'. $inv->id,
                    'full_name' => $inv->tenant_name,
                    'payment_date' => $attributes['payment_date'],
                ]);
                $is_paid = $inv->balance - $attributes['amount'] > 0 ? 0 : 1;
                $balance = $inv->balance - $attributes['amount'];
                $inv->update([
                    'is_paid' => $is_paid,
                    'balance' => $balance,
                    'paid_in' => $attributes['amount'],
                ]);
               
                
                $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Invoice Manual Payment by Administrator:' . auth()->user()->username,
            'more_info' => 'Invoice Type: Member Invoice ',
            'tenant_id' => '0',
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '0',
                    'invoice_id' => '1',
                    'subscription_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '1',
                    'servicerequest_id' => '0',
        ]);
            }
            $sms_to_send = [];
            $sms_to_send_admin = [];
            $tenant_full_name = $inv->tenant_name;
            $arr_names = explode(' ', trim(ucfirst(strtolower($tenant_full_name))));
            $tenant_first_name = $arr_names[0];
            $tenant_last_name_n_first = $tenant_first_name === end($arr_names) ? $tenant_first_name : $tenant_first_name . ' ' . end($arr_names);
            $payment_month = date('M-Y', strtotime($attributes['payment_date']));
            
            $receipt = Receipt::create([
                'name'=>$inv->tenant_name,
                'phone_number'=>$inv->tenant_phone,
                'transaction_code'=>$attributes['reference'],
                'payment_method'=>$attributes['payment_type'],
                'rent_amount'=>$payment_month,
                'tenant_id'=>$inv->tenant_id,
                'amount'=>$attributes['amount'],
                'balance'=>$balance,
            ]);
            
            array_push($sms_to_send, $this->paymentConfirmationSmsFormat([
                'name' => $tenant_first_name,
                'amt_paid' => $payment->TransAmount,
                'prepayment' => $inv->prepayment,
                'balance' => $balance,
                'receipt_id'=>$receipt->id,
                'amount' => $inv->renewal,
                // 'phone' => (int) $tenant->phone,
                'phone' => (int) '254714264331',
            ]));
            array_push($sms_to_send_admin, $this->paymentConfirmationSmsFormatAdmin([
                'name' => $tenant_last_name_n_first,
                'amt_paid' => $payment->TransAmount,
                'prepayment' => $inv->prepayment,
                'balance' => $balance,
                'transaction_code' => $payment->TransID,
                'tenant_id' => $inv->id,
                'rent' => $inv->renewal,
                // 'phone' => (int) $tenant->phone,
                'phone' => (int) '254714264331',
            ]));
            $data =['name'=> $tenant_first_name,'transaction_code'=> $payment->TransID,'amount_paid'=>$payment->TransAmount, 'balance'=>$balance, 'invoice'=>$inv->id, 'invoice_number'=>$inv->invoice_number];
        \Mail::to($inv->tenant->email)->send(
                        new ConfirmPayment($data)
                    );
    
            // return response()->json([$sms_to_send, $sms_to_send_admin]);
             $this->sendMessage($sms_to_send);
             $this->sendMessage($sms_to_send_admin);
            return back()->with('success', 'Payment added successfully to the member invoice');
        }
       

       

 
        
    }

    public function reconcileInvoicePayment(InvoiceRequest $request)
    {

        // DB::beginTransaction();
        // try {
        $invoice = Invoice::findOrFail($request->invoice_id);
        //grab current invoice balance
        $balance = $invoice->balance;

        $invoice->update([
            'paid_in' => $request->paid_in + $invoice->paid_in + $invoice->deposit_paid,
            'balance' => $balance - $request->paid_in,
            'is_paid' => ($balance - $request->paid_in <= 0) ? true : false,
            'payment_method' => $request->payment_method,
        ]);
        // $invoice->save();

        // if ($request->current_overpayment > 0) {
        //     $overpayment = Overpayment::where('tenant_id', $request->tenant_id)->update([
        //         'amount' => 0,
        //     ]);
        // }

        // if ($request->filled('new_overpayment')) {
        //     $overpayment_2 = Overpayment::updateOrCreate(
        //         ['tenant_id' => $request->tenant_id],
        //         ['amount' => $request->new_overpayment]
        //     );

        // }
        $updated_invoice = Invoice::findOrFail($request->invoice_id);
        $notificationBody = [
            'amt_paid_in' => $request->paid_in,
            'amt_balance' => $updated_invoice->balance + $invoice->penalty_fee,
            'amt_total_paid' => $updated_invoice->paid_in,
            'tenant_info' => $updated_invoice->tenant,
            'date_paid' => $updated_invoice->updated_at,
        ];

        DB::commit();
        $this->sendMessage((object) $notificationBody);
        // $this->sendEmail((object) $notificationBody);
        return redirect()->route('invoice.all')
            ->with('success', 'Invoice for ' . $invoice->tenant->full_name . ' has been successfully paid');

        // } catch (\Exception $th) {
        //     DB::rollback();
        //     return back()->with('error', 'Error with database');

        //  }

    }

    // public function showOverpayments()
    // {
    //     return view('invoices.overpayments');
    // }

    public function showInvoice($id, $action = null)
    {
        $invoice = Invoice::with('tenant', 'house')->findOrFail($id);

        // $invoice_payments = ManualPayment::where('MSISDN', $invoice->tenant->phone)->get();

        $overpayment = 0;
        $overpayments = Overpayment::where('tenant_id', $invoice->tenant_id)->get();

        if (count($overpayments) > 0) {
            $overpayment = Overpayment::where('tenant_id', $invoice->tenant_id)->first()->value('amount');
        }

        $billings = MonthlyBilling::where('billing_month', $invoice->rent_month)
            ->where('house_id', $invoice->house_id)
            ->get();

        // if (!$action) {
        //     return view('invoices.invoiceprint', compact('invoice', 'billings', 'overpayment'));
        // }

        switch ($action) {
            case 'print':
                return view('invoices.invoiceprint', compact('invoice', 'billings', 'overpayment'));
            case 'message':
                $current_invoice = Invoice::with('tenant')->where('id',$id)->first();
                
            $smses = [];
            $sms_object = $this->invoiceMessageFormat([
                // 'phone' => $inv[0]->tenant->phone,
                'tenant' => $current_invoice->tenant,
                'to_pay' =>  $current_invoice->balance,
                'phone' => (int) $current_invoice->tenant->phone,
            ]);
        array_push($smses, $sms_object);
        $this->sendMessage($smses);
                return back()->with('success', 'Message sent successfully'); 
            case 'pdf':
                // return view('invoices.invoicepdf', compact('invoice', 'billings', 'overpayment'));

                $pdf = PDF::loadView('invoices.invoicepf', compact('invoice', 'billings', 'overpayment'));
                return $pdf->stream('Invoice #' . $id . '.pdf');
            default:
                return view('invoices.invoice', compact('invoice', 'billings', 'overpayment'));
                break;
        }

    }

    public function pdfInvoice($id)
    {
        $invoice = Invoice::with('tenant', 'house')->findOrFail($id);

        $overpayment = 0;
        $overpayments = Overpayment::where('tenant_id', $invoice->tenant_id)->get();

        if (count($overpayments) > 0) {
            $overpayment = Overpayment::where('tenant_id', $invoice->tenant_id)->first()->value('amount');
        }

        $billings = MonthlyBilling::where('billing_month', $invoice->rent_month)
            ->where('house_id', $invoice->house_id)
            ->get();

        // $pdf = PDF::loadView('invoices.invoicepdf', compact('invoice', 'billings', 'overpayment'));

        // return $pdf->stream('Invoice #' . $id . '.pdf');

        return view('invoices.invoicepdf', compact('invoice', 'billings', 'overpayment'));

    }

    public function delete($id)
    {
        $invoice = Invoice::findOrFail($id);
         $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Deleted Invoice number' . $invoice->id,
            'more_info' => 'Invoice deleted by' . auth()->user()->username ,
            'tenant_id' => $invoice->tenant_id,
                    'house_id' => '0',
                    'apartment_id' => '0',
                    'landlord_id' => '0',
                    'bill_id' => '0',
                    'invoice_id' => $invoice->id,
                    'subscription_id' => '0',
                    'sms_id' => '0',
                    'user_id' => '0',
                    'servicerequest_id' => '0',
        ]);
        $invoice->delete();

        return back()->with('success', 'Invoice has been deleted');
    }

     private function paymentConfirmationSmsFormat($notificationBody)
    {
        $userData = (object) $notificationBody;

        $tenant_first_name = $userData->name;
        $amt_paid = $userData->amt_paid;

        $format = "Dear %s,\nYour payment of Ksh %d has been received.";
        $message_text = sprintf($format, $tenant_first_name, $amt_paid);

        $rent_section = "\nAmount: Ksh %d";
        $message_text .= sprintf($rent_section, $userData->amount);
        $prepayment = $userData->prepayment > 0 ? true : false;

        // if ($arrears) {
        //     $arrears_section = "\nArrears: Ksh %d";
        //     $message_text .= sprintf($arrears_section, $userData->arrears);
        // }
        // if ($prepayment) {
        //     $prepayment_section = "\nPrepayment: Ksh %d";
        //     $message_text .= sprintf($prepayment_section, $userData->prepayment);
        // }
        $to_pay_section = "\nBalance: Ksh %d";
        $message_text .= sprintf($to_pay_section, $userData->balance);
        
        //  $receipt = "\nReceipt: http://demo.claire.co.ke/receipt/%d/index";
        // $message_text .= sprintf($receipt, $userData->receipt_id);

        $message_text .= "\nFor enquiries call 0700000000.";

        $data = [
            'from' => config('app.sms_client'),
            'to' => $userData->phone,
            'text' => $message_text,
        ];

        return $data;
    }

    private function paymentConfirmationSmsFormatAdmin($notificationBody)
    {
        $userData = (object) $notificationBody;

        $tenant_name = $userData->name;
        $amt_paid = $userData->amt_paid;
        $arr_prep_string = $userData->prepayment > 0 ? $userData->prepayment : '';
        $acc_num = $userData->account_number;
        $transaction_code = $userData->transaction_code;

        $format = "%s has made a payment.\nMember#: %s\nPaid: %d\nTransaction Code: %s\n%s";
        $message_text = sprintf($format, $tenant_name, $acc_num, $amt_paid, $transaction_code, $arr_prep_string);

        $data = [
            'from' => config('app.sms_client'),
            'to' => (int) config('app.sms_admin_phone'),
            
            // 'to' => (int) config('app.sms_test_phone'),
            'text' => $message_text,
        ];

        return $data;
       
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
                    'is_paid' => ($balance <= 0) ? true : false,
                    'payment_method' => 'Cash',
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

    private function dateFormater($date_format, $date, $converted_format)
    {
        return \DateTime::createFromFormat($date_format, $date)->format($converted_format);
    }

    private function invoiceMessageFormat($notificationBody)
    {
        $userData = (object) $notificationBody;
        $account_number = 'INV00'. $userData->id;

        $amount = $userData->to_pay;

        $tenant_full_name = $userData->tenant->full_name;
        $arr_names = explode(' ', trim(ucfirst(strtolower($tenant_full_name))));
        $tenant_first_name = $arr_names[0]; // will print Test

        $format = "Dear %s,\nYour amount has been updated.\nPlease pay Ksh %d to:\nPaybill: 123456\nAccount: %s";
        $message_text = sprintf($format, $tenant_first_name, $amount, $account_number);

        $message_text .= "\nFor enquiries call 0700000000.";

        $data = [
            'from' => 'Membership Management System',
            'to' => (int) $userData->phone,
            'text' => $message_text,
        ];

        return $data;
        return back()->with('success', 'Message sent successfully'); 

    }
}
