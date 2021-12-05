<?php

namespace App\Console\Commands;

use App\Traits\NotifyClient;
use Illuminate\Console\Command;

use App\House;
use App\HouseTenant;
use App\Invoice;
use App\ManualPayment;
use App\MonthlyBilling;
use App\Overpayment;
use App\Tenant;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use PDF;

class RentPaymentAppeal extends Command
{
    use NotifyClient;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:rentappeal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rent Appeal Sms sent(Sent on 28th, 4th and 9th)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $var = Carbon::now()->format('M-Y');
        $invoices = Invoice::with('tenant')->get()->groupBy('tenant_id');

        $grouped_invoices = [];

        foreach ($invoices as $inv) {
            //if($inv)
            $rent_of_current_month = Invoice::where('tenant_id', $inv[0]->tenant_id)->where('rent_month', $var)->sum('rent');
            $total_payable_of_current_month = Invoice::where('tenant_id', $inv[0]->tenant_id)->where('rent_month', $var)->sum('total_payable');
            $arreas = Invoice::where('tenant_id', $inv[0]->tenant_id)->where('rent_month', '!=', $var)->sum('total_payable');
            $bills = $total_payable_of_current_month - $rent_of_current_month;
            
            $acc_num = $inv[0]->tenant && $inv[0]->tenant->account_number ? $inv[0]->tenant->account_number : 0;
            $tenant_phone = $inv[0]->tenant && $inv[0]->tenant->phone ? $inv[0]->tenant->phone : 0;
             $all_tenant_payments = ManualPayment::where('InvoiceNumber',  $acc_num)->orWhere('MSISDN', $tenant_phone)->get();
             
            $total_tenant_payments = $all_tenant_payments->sum('TransAmount');
            // $tenant['total_paid_in'] = $all_tenant_invoices->sum('paid_in');
            // $total_tenant_payable = $all_tenant_invoices->sum('total_payable');
            
// if (in_array((int) $inv[0]->tenant->phone, $numbers)) {
//     echo "Got Irix";
// }
$tenant_id = $inv[0]->tenant && $inv[0]->tenant->id ? $inv[0]->tenant->id : 0;
$tenant_has_house = HouseTenant::where('tenant_id',$tenant_id )->first();
$topay = $arreas + $total_payable_of_current_month -  $total_tenant_payments;
            if($inv[0]->tenant){
                $sms_object = $this->rentAppealSmsFormat([
                    // 'phone' => (int)'254714264331',
                    'tenant' => $inv[0]->tenant,
                    'to_pay' =>   $arreas + $total_payable_of_current_month -  $total_tenant_payments,
                    'month_bills' => $bills,
                    'rent_amount' => $rent_of_current_month,
                    'arreas' => $arreas,
                    'prepayment' => $inv->sum('overpayment'),
                    'phone' => (int) $inv[0]->tenant->phone,
                ]);
                if($tenant_has_house){
                array_push($grouped_invoices, $sms_object);
                }
            }


        }
// $grouped_invoices = array_slice($grouped_invoices,0,1);
// return response()->json($grouped_invoices);
//return response()->json(count($grouped_invoices));
return response()->json($this->sendMessage($grouped_invoices));
    }
    
     private function rentAppealSmsFormat($notificationBody)
    {
        $userData = (object) $notificationBody;
        $account_number = $userData->tenant->account_number;

        $amount = $userData->rent_amount;

        $tenant_full_name = $userData->tenant->full_name;
        $arr_names = explode(' ', trim(ucfirst(strtolower($tenant_full_name))));
        $tenant_first_name = $arr_names[0]; // will print Test

        $format = "Dear %s,\nMake All your rent payments using:\nMpesa Paybill:743994\nAcc #: %s\nor\nBank Deposit\nBank:KCB\nName:Lesa Int'l Agencies\nAcc #: 1177934779\nRef:%s\nCASH PAYMENTS WILL NOT BE ACCEPTED";
        $message_text = sprintf($format, $tenant_first_name, $account_number,$account_number, $amount);

        
        $message_text .= "\nFor enquiries 0797597530.";

        $data = [
            'from' => 'LesaAgency',
            'to' => (int) $userData->phone,
            'text' => $message_text,
        ];

        return $data;

    }
}
