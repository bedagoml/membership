<?php

namespace App\Console\Commands;

use App\Traits\NotifyClient;
use Illuminate\Console\Command;


use App\Invoice;
use App\ManualPayment;
use App\MonthlyBilling;
use App\Overpayment;
use App\Tenant;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Traits\UtilTrait;
use PDF;

class DeleteUsers extends Command
{
    use NotifyClient;
    use UtilTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command that removes users after the set ending date date';

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
        $var = Carbon::now()->format('Y-m-d');
        $users = User::where('ending_date','<', $var)->where('trial', 1)->forceDelete();
         $this->createLog([
            'username' => 'Auto deletion',
            'operation' => 'User Deleted by command',
            'more_info' => 'Username: Auto deletion',
            'user_id' => 1,
            'tenant_id' => '0',
            'servicerequest_id' => '0',
            'subscription_id' => '0',
            'house_id' => '0',
            'apartment_id' => '0',
            'landlord_id' => '0',
            'bill_id' => '0',
            'invoice_id' => '0',
            'sms_id' => '0',
        ]);
        
    }
}
