<?php
namespace App\Traits;

use App\Log;
use App\Sms;
use App\Tenant;
use App\Invoice;
use GuzzleHttp\Client;
trait UtilTrait
{
    public function generateUserAccountNumber()
    {
        $tenantsCount = Invoice::get()->count();
        $length = 4;
        $acc_num = 'INV' . substr(str_repeat(0, $length) . $tenantsCount, -$length);
        $invoice_found = Invoice::where('invoice_number', $acc_num)->first();
        $x = 1;
        while ($invoice_found) {
            $tenantsCount = Invoice::get()->count() + $x;
            $length = 4;
            $acc_num = 'INV' . substr(str_repeat(0, $length) . $tenantsCount, -$length);
            $invoice_found = Invoice::where('invoice_number', $acc_num)->first();
            $x+=1;
        }
        return  $acc_num;
    }
    public function generateUserPassword()
    {
        $tenantsCount = Tenant::get()->count();
        $length = 4;
        $pass = 'Mem' . substr(str_repeat(0, $length) . $tenantsCount, -$length);
        $tenant_found = Tenant::where('test_password', $pass)->first();
        $x = 1;
        while ($tenant_found) {
            $tenantsCount = Tenant::get()->count() + $x;
            $length = 4;
            $pass = 'Mem' . substr(str_repeat(0, $length) . $tenantsCount, -$length);
            $tenant_found = Tenant::where('test_password', $pass)->first();
            $x+=1;
        }
        return  $pass;
    }

    public function createLog($request_data)
    {
        Log::create([
            'user_name' => $request_data['username'],
            'operation' => $request_data['operation'],
            'more_info' => $request_data['more_info'],
            'tenant_id' => $request_data['tenant_id'],
            'servicerequest_id' => $request_data['servicerequest_id'],
            'subscription_id' => $request_data['subscription_id'],
            'house_id' => $request_data['house_id'],
            'apartment_id' => $request_data['apartment_id'],
            'landlord_id' => $request_data['landlord_id'],
            'bill_id' => $request_data['bill_id'],
            'invoice_id' => $request_data['invoice_id'],
            'sms_id' => $request_data['sms_id'],
            'user_id' => $request_data['user_id'],
        ]);
    }

    public function smsData($request_data)
    {
        Sms::create([
            'type' => 'System Sms',
            'message_body' => $request_data['message_body'],
            'message_count' => $request_data['message_count'],
        ]);
    }

}
