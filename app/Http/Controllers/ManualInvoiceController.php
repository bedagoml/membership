<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManualInvoiceRequest;
use App\Invoice;
use App\ManualPayment;
use App\ManagerPayment;
use App\Tenant;
use Carbon\Carbon as CarbonCarbon;
use App\Traits\FileManager;
use App\Traits\NotifyClient;
use App\Traits\UtilTrait;

class ManualInvoiceController extends Controller
{
    use NotifyClient;
    use UtilTrait;
    use FileManager;
   
    public function create($id = null)
    {

        if ($id) {

            $tenants = Tenant::findOrFail($id);
           return view('manualinvoices.acccreate', compact('tenants'));
           

        } else {
            $tenants = Tenant::pluck('id', 'full_name');
            return view('manualinvoices.create', compact('tenants'));
        }

    }

    public function pay()
    {
        $tenants = Tenant::pluck('id', 'full_name');
        $invoices = Invoice::where('balance','!=', 0)->get();
        return view('manualinvoices.pay', compact('tenants', 'invoices'));
    }

    function list() {
        return view('manualinvoices.list');
    }
    function payments() {
        return view('manualinvoices.payments');
    }
    function paymentlist() {
        return view('manualinvoices.paymentlist');
    }

    public function destroy($id)
    {
        $payments = ManualPayment::findOrFail($id);
        $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Manual Payment Deleted',
            'more_info' => 'It was an approved payment',
            'servicerequest_id' => '0',
            'tenant_id' => '1',
            'subscription_id' => '0',
            'house_id' => '0',
            'subscription_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
         
        ]);
        $payments->delete();

        return back()->with('success', 'Approved Payment has been deleted from system');

    }
    public function paymentdelete($id)
    {
        $payments = ManagerPayment::findOrFail($id);
       $this->createLog([
            'username' => auth()->user()->username,
            'operation' => 'Manual Payment Deleted',
            'more_info' => 'It was a pending payment',
            'servicerequest_id' => '0',
            'tenant_id' => '1',
            'subscription_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
            'user_id' => '0',
         
        ]);
        $payments->delete();

        return back()->with('success', 'Pending Payment has been deleted from system');

    }
    public function store(ManualInvoiceRequest $request)
    {
        // return response()->json($request->all());
        $attributes = $request->validate([
            'type' => 'required',
            'tenant_id' => 'required',
            'total_payable' => 'required',
            'description' => 'required',
        ]);
        // return response()->json($request->all());
        $var = CarbonCarbon::now()->format('M-Y');
        $year = CarbonCarbon::now()->format('Y');
        $tenant= Tenant::where('id', $request->tenant_id)->first();
        Invoice::create([
            'renewal' =>$request->total_payable,
            'type' => $request->type,
            'invoice_number' => $this->generateUserAccountNumber(),
            'tenant_id' =>$request->tenant_id,
            'total_payable' => $request->total_payable,
            'balance' => $request->total_payable,
            'tenant_name' => $tenant->full_name,
            'description' => $request->description,
            'rent_month' => $var,
            'subscription_year' => $year,
            'tenant_phone' => $tenant->phone,
            //'source_tenant_phone'=>$request->source_tenant_phone, //should add column to db then uncomment
            // 'house_id' => 1, //should make house id nullable for now I used 1
            // 'apartment_id' => 1, //should make apartment id nullable for now I used 1
             //should make tenant id nullable for now I used 1
        ]);

        return back()->with('success', 'An invoice has been raised to the system awaiting payment');

    }
     public function paymentedit($id)
    {
        
        $managerpayment = ManagerPayment::findOrFail($id);
        $invoices = Invoice::pluck('id', 'tenant_id');
       
        $tenants = Tenant::pluck('id', 'full_name');
        
        return view('manualinvoices.paymentedit', compact('managerpayment', 'tenants'));
    }

}
