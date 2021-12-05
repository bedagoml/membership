<?php

namespace App\Console\Commands;

use App\Traits\NotifyClient;
use Illuminate\Console\Command;


use App\ManualPayment;
use App\MonthlyBilling;
use App\Overpayment;
use App\Tenant;
use App\House;
use App\Invoice;

 

class SynchronizeInvoicesandPayments extends Command
{
    use NotifyClient;
    
 
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoices:synchronize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates unpaid invoices with client payments';

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
        // $grouped_invoices = [];
        // $data = [
        //     'from' => 'LesaAgency',
        //      'to' => 254714264331,
        //     'text' => 'Invoice synchronization successful',
        // ];
        // array_push($grouped_invoices, $data);
        // $this->sendMessage($grouped_invoices);
        
        $invoices = Invoice::all();
        foreach ($invoices as $inv) {
            $inv->update([
                'is_paid' => 0,
                'total_payable' => $inv->amount,
                'balance' => $inv->amount,
                'paid_in' => 0,
            ]);
        }
        $invoices = Invoice::get(['is_paid', 'balance', 'paid_in']);
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            // $tenant_payments_sum = ManualPayment::where('InvoiceNumber', $tenant->account_number)->orWhere('MSISDN', $tenant->phone)->get()->sum('TransAmount');
            $tenant_payments_sum = ManualPayment::where('InvoiceNumber', $tenant->account_number)->get()->sum('TransAmount');
            $invoices = Invoice::where('tenant_id', $tenant->id)->get();
            $this->updateClientInvoices($invoices, $tenant_payments_sum);
        }
        return 'Synchronization Complete';
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
}
