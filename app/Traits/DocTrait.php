<?php
namespace App\Traits;

use App\AgencyExpense;
use App\Deposit;
use App\Income;
use App\House;
use App\HouseTenant;
use App\Apartment;
use App\Invoice;
use App\Landlord;
use App\ManualPayment;
use App\BillsPayment;
use App\Contribution;
use App\HappyHundred;
use App\Meeting;
use App\Meeting_invoice;
use App\PayOwner;
use App\PlacementFee;
use App\Tenant;
use GuzzleHttp\Client;
trait DocTrait
{

    public function getTenantData($tenant_id, $dates)
    {
        if (count($dates) > 0) {
            $from = $dates['from'] . " 00:00:00";
            $to = $dates['to'] . " 23:59:00";
            // dd($tenant_id);
           $tnt = Tenant::where('id',$tenant_id)->first();
            $invoices = Invoice::where('tenant_id', $tenant_id)
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();
                $invoice = Invoice::where('tenant_id', $tenant_id)->get();
                // dd($invoices->sum('amount'));
            $payments = ManualPayment::where('InvoiceNumber', $tnt->account_number)
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();
        }
        
        $rent_sum = $invoice->sum('total_payable');
        // dd($rent_sum);
        $bills_sum =  '0';
        $penalty_sum = $invoices->sum('penalty');

        $sanitized_records = [];
        $deposit_sum = 0;
        $arrears_sum = 0;
        foreach ($invoices as $inv) {
            
            
            
            if ($inv->carryforward > 0) {

                // foreach ($checkDeposits as $deposit) {
                array_push($sanitized_records, [
                    'type' => 'Invoice',
                    'description' => 'Arrears',
                    'date' => date('d-m-Y', strtotime($inv->created_at)),
                    'reference' => $this->invoice_number($inv->id),
                    'amount' => $inv->carryforward,
                    'paid_in' => '-',
                    'balance' => '-',
                ]);
                 $arrears_sum += $inv->carryforward;

            }
            $record = [
                'type' => 'Invoice',
                'description' => 'Subscription Invoice',
                'date' => date('d-m-Y', strtotime($inv->created_at)),
                'reference' => $this->invoice_number($inv->id),
                'amount' => $inv->amount,
                'paid_in' => '-',
                'balance' => $inv->balance,
            ];
            array_push($sanitized_records, $record);
        }
        foreach ($payments as $pmt) {
            $record = [
                'type' => 'Payment',
                'description' => 'Payment',
                'date' => date('d-m-Y', strtotime($pmt->created_at)),
                'reference' => $pmt->TransID,
                'amount' => '-',
                'paid_in' => $pmt->TransAmount,
                'balance' => '-',
            ];
            array_push($sanitized_records, $record);
        }
        usort($sanitized_records, [$this, 'cb']);
        //$sanitized_records = collect($sanitized_records)->sortBy('date')->all();

        $other_info = $this->otherInfo($tenant_id, $dates, 'tenant');

        $entries = [];
        foreach ($sanitized_records as $sa) {
            array_push($entries, $sa);
        }

        $payments = $this->sumArrayOfObjects($entries, 'paid_in');

        $total_bills = $rent_sum + $arrears_sum;
        // dd($total_bills);
        $total = $total_bills;
        $balance = abs($total_bills - $payments);

        $info['entries'] = $entries;
        $info['deposit_sum'] = number_format(($deposit_sum), 2);
        $info['others_sum'] = number_format(($bills_sum + $penalty_sum + $arrears_sum), 2);
        $info['rent_sum'] = number_format($rent_sum, 2);
        $info['payments'] = number_format($payments, 2);
        $info['total'] = number_format($total, 2);
        $info['balance'] = number_format($balance, 2);
        $info['other_info'] = $other_info;

        return $info;
    }
    
    public function getEventData($meeting_id)
    {
       
           $events = Meeting::where('id',$meeting_id)->first();
            $evnt_registration = Meeting_invoice::where('meeting_id', $events->id)->get();
                // $tenant_registration = Meeting_invoice::where('tenant_id', $evnt->tenant->id)->first();
                $invoices = Invoice::where('type', '=', 'Event Invoice')->get();
                
               foreach ($invoices as $invo){
                if($invo->invoice_number)
                 $payments = ManualPayment::where('InvoiceNumber', $invo->invoice_number)->get();
                }
              
                
               
              
            
        
        
        $rent_sum = $invoices->sum('total_payable');
        // dd($rent_sum);
        $bills_sum =  '0';
        // $penalty_sum = $invoices->sum('penalty');

        $sanitized_records = [];
        $deposit_sum = 0;
        $arrears_sum = 0;
     
       


        foreach ($invoices as $inv) {
            
            
            
            if ($inv->carryforward > 0) {

                // foreach ($checkDeposits as $deposit) {
                array_push($sanitized_records, [
                    'type' => 'Invoice',
                    'description' => 'Arrears',
                    'date' => date('d-m-Y', strtotime($inv->created_at)),
                    'reference' => $this->invoice_number($inv->id),
                    'amount' => $inv->carryforward,
                    'paid_in' => '-',
                    'balance' => '-',
                    'meeting_title' => '-',
                'meeting_time' =>     '-',         
                 'meeting_amount' => '-',
                'tenant_name' =>    '-', 
                ]);
                 $arrears_sum += $inv->carryforward;

            }
            $record = [
                'type' => 'Invoice',
                'description' => 'Event Invoice',
                'date' => date('d-m-Y', strtotime($inv->created_at)),
                'reference' => $inv->invoice_number,
                'amount' => $inv->total_payable,
                'paid_in' => '-',
                'balance' => $inv->balance,
                'meeting_title' => 'Event Invoice',
                'meeting_time' =>     '-',         
                 'meeting_amount' => '-',
                'tenant_name' =>    $inv->tenant_name, 
               
            ];
            array_push($sanitized_records, $record);
        }
        // if ($payments != 'No Payment')
        // foreach ($payments as $pmt) {
        //     $record = [
        //         'type' => 'Payment',
        //         'description' => 'Event Payment',
        //         'date' => date('d-m-Y', strtotime($pmt->created_at)),
        //         'reference' => $pmt->TransID,
        //         'amount' => '-',
        //         'paid_in' => $pmt->TransAmount,
        //         'balance' => '-',
        //         'meeting_title' => '-',
        //         'meeting_time' =>     '-',         
        //          'meeting_amount' => '-',
        //         'tenant_name' =>    '-',     
        //     ];
        //     array_push($sanitized_records, $record);
        // }
        foreach ($evnt_registration as $reg) {

            
            $record = [
                'type' => '-',
                'description' => 'Event Payment',
                'date' =>  date('d-m-Y', strtotime($reg->created_at)),
                'reference' => '-',
                'amount' => '-',
                'paid_in' => '-',
                'balance' => '-',
                'meeting_title' => $reg->meeting->meeting_title,
                'meeting_time' => $reg->meeting->meeting_time,
                'meeting_amount' => $reg->meeting->meeting_amount,
                'tenant_name' => $reg->tenant->full_name,
               
            ];
            array_push($sanitized_records, $record);
        }
        usort($sanitized_records, [$this, 'cb']);
        //$sanitized_records = collect($sanitized_records)->sortBy('date')->all();

        

        $entries = [];
        foreach ($sanitized_records as $sa) {
            array_push($entries, $sa);
        }

        $payments = $this->sumArrayOfObjects($entries, 'paid_in');

        $total_bills = $rent_sum + $arrears_sum;
        // dd($total_bills);
        $total = $total_bills;
        $balance = $total_bills - $payments;

        $info['entries'] = $entries;
        $info['rent_sum'] = number_format($rent_sum, 2);
        $info['payments'] = number_format($payments, 2);
        $info['total'] = number_format($total, 2);
        $info['balance'] = number_format($balance, 2);
      

        return $info;
    }
     public function getIncomeData($dates)
    {
        
        if (count($dates) > 0) {
            $from = $dates['from'] . " 00:00:00";
            $to = $dates['to'] . " 23:59:00";
            $donations = Contribution::get();
            foreach($donations as $dons){
            $allpayments = ManualPayment::where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->where('InvoiceNumber','!=', $dons->project_title)->get();
                $donationpayment = ManualPayment::where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->where('InvoiceNumber', $dons->project_title)->get();
                $payments = ManualPayment::where('InvoiceNumber','!=', $dons->project_title)->sum('TransAmount');
                $donationpayments = ManualPayment::where('InvoiceNumber', $dons->project_title)->sum('TransAmount');
            }
            $allhappy = HappyHundred::where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();
           
            $happy_hours_payments = HappyHundred::sum('amount');
            $expense = PayOwner::where('bill_source', 'Happy Hundreds')->get();
            $expensepay = BillsPayment::get();
        } else{
            'Please select date';
        }
        
        $sanitized_records = [];
       
      
           
        foreach ($allpayments as $pmt) {
            if($pmt->FirstName != null){
            $record = [
                'member_name' => $pmt->FirstName . " " . $pmt->LastName,
                'description' => 'MPESA Payment',
                'date' => date('d-m-Y', strtotime($pmt->created_at)),
                'reference' => $pmt->TransID,
                'paid_in' => $pmt->TransAmount,
                'paid' => '-',
                'happy'  => '-',
                'happy_2' => '-',
                'happy_1' => '-',
            ];   
            }
            else{
              $record = [
                'member_name' => $pmt->full_name,
                'description' => 'Manual Payment',
                'date' => date('d-m-Y', strtotime($pmt->created_at)),
                'reference' => $pmt->TransID,
                'paid_in' => $pmt->TransAmount,
                'paid' => '-',
                'happy'  => '-',
                'happy_2' => '-',
                'happy_1' => '-',
            ];  
            }
            array_push($sanitized_records, $record);
        }
        usort($sanitized_records, [$this, 'cb']);

        foreach ($donationpayment as $ppmt) {
            if($ppmt->FirstName != null){
            $record = [
                'member_name' => $ppmt->FirstName . " " . $ppmt->LastName,
                'description' => 'MPESA Payment: ' . $ppmt->InvoiceNumber,
                'date' => date('d-m-Y', strtotime($ppmt->created_at)),
                'reference' => $ppmt->TransID,
                'paid' => $ppmt->TransAmount,
                'paid_in' => '-',
                'happy'  => '-',
                'happy_2' => '-',
                'happy_1' => '-',
            ];   
            }
            else{
              $record = [
                'member_name' => $ppmt->full_name,
                'description' => 'Manual Payment: ' . $ppmt->InvoiceNumber,
                'date' => date('d-m-Y', strtotime($ppmt->created_at)),
                'reference' => $ppmt->TransID,
                'paid' => $ppmt->TransAmount,
                'paid_in' => '-',
                'happy'  => '-',
                'happy_2' => '-',
                'happy_1' => '-',
            ];  
            }
            array_push($sanitized_records, $record);
        }
        usort($sanitized_records, [$this, 'cb']);
        foreach ($allhappy as $pp) {
           
            $record = [
                'member_name' => $pp->tenant->full_name,
                'description' => 'MPESA Till Payment',
                'date' => date('d-m-Y', strtotime($pp->created_at)),
                'reference' => $pp->transaction_code,
                'happy' => $pp->amount,
                'paid_in' => '-',
                'paid'  => '-',
                'happy_2' => '-',
                'happy_1' => '-',
            ]; 
            array_push($sanitized_records, $record);
        }
        usort($sanitized_records, [$this, 'cb']);
        foreach ($expensepay as $pip) {
           
            $record = [
                'member_name' => 'Eclub Safaris',
                'description' => 'Bill Payment',
                'date' => date('d-m-Y', strtotime($pip->created_at)),
                'reference' => $pip->TransID,
                'happy' => '-',
                'paid_in' => '-',
                'paid'  => '-',
                'happy_2' => $pip->TransAmount,
                'happy_1' => '-',
            ]; 
            array_push($sanitized_records, $record);
        }
        usort($sanitized_records, [$this, 'cb']);
        foreach ($expense as $pip) {
           
            $record = [
                'member_name' => 'Eclub Safaris',
                'description' => 'Bill Raised',
                'date' => date('d-m-Y', strtotime($pip->created_at)),
                'reference' => $pip->bill_source,
                'happy_1' => $pip->total_owned,
                'paid_in' => '-',
                'paid'  => '-',
                'happy'  => '-',
                'happy_2' => '-',
            ]; 
            array_push($sanitized_records, $record);
        }
        usort($sanitized_records, [$this, 'cb']);

       

        $entries = [];
        foreach ($sanitized_records as $sa) {
            array_push($entries, $sa);
        }

        $payments = $this->sumArrayOfObjects($entries, 'paid_in');
        $donationpayments = $this->sumArrayOfObjects($entries, 'paid');
        $happy_hours_payments = $this->sumArrayOfObjects($entries, 'happy');
        $expense = $this->sumArrayOfObjects($entries, 'happy_1');
        $expensepay = $this->sumArrayOfObjects($entries, 'happy_2');
        $total_income = $payments + $donationpayments + $happy_hours_payments;
        $balance = $total_income - $expensepay;
        $expensebalance = $expense - $expensepay;
     

        $info['entries'] = $entries;
        $info['payments'] = number_format($payments, 2);
        $info['donationpayments'] = number_format($donationpayments, 2);
        $info['happy_hours_payments'] = number_format($happy_hours_payments, 2);
        $info['expensepay'] = number_format($expensepay, 2);
        $info['expense'] = number_format($expense, 2);
        $info['total_income'] = number_format($total_income, 2);
        $info['balance'] = number_format($balance, 2);
        $info['expensebalance'] = number_format($expensebalance, 2);
      

        return $info;
    }
    public function getPropertyOwnerData($owner_id, $dates)
    {

        if (count($dates) > 0) {
            $from = $dates['from'];
            $to = $dates['to'];
            $from = $this->dateFormater('d/m/Y', $from, 'Y-m-d');
            $to = $this->dateFormater('d/m/Y', $to, 'Y-m-d');
            $property_owner_data = PayOwner::where('apartment_id', $owner_id)
                ->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();
        } else {
            $property_owner_data = PayOwner::where('apartment_id', $owner_id)->get();
        }
        //return $property_owner_data->groupBy('apartment_id');
        $property_owner_info_array = [];
        $property_owner_info_array_info = [];
        $commission_total = 0;
        foreach ($property_owner_data as $info_data) {
            $commission = $info_data->rent * ($info_data->mgt / 100);
            
            $apartment_info = Apartment::where('id',$info_data->apartment_id)->first();
            $apartment_name = $apartment_info->name;
            
            if($info_data->type === 'Rent Collection'){
                
                $billData = $this->checkBill($info_data);
                if($billData){
                    $billInfo = $billData[0].'('.$apartment_name.')';
                }else{
                    $billInfo = 'Rent Collection'.'('.$apartment_name.')';
                     $billData[1] = $info_data->rent;
                     
                    if($info_data->paid_in && $info_data->paid_in > 0){
                         $billInfo = 'Remittance'.'('.$apartment_name.')';
                          $billData[1] = $info_data->paid_in;
                    }
                   
                }
                array_push($property_owner_info_array_info, [
                'date' => date('Y-m-d', strtotime($info_data->created_at)),
                
                    'description' => $billInfo,
                    'reference' => '-',
                    'amount' => number_format($billData[1], 2),
                    'paid' => '-',
                ]);
            }
            
            $apartment_payment = $this->checkPayment($info_data, $apartment_name);
                
            if($apartment_payment){
                array_push($property_owner_info_array_info, [
                'date' =>  $apartment_payment[2],
                    'description' =>  $apartment_payment[0],
                    'reference' =>  $apartment_payment[3],
                    'amount' => '-',
                    'paid' =>  number_format($apartment_payment[1], 2),
                ]);
            }
            if($info_data->house_id != null){
            array_push($property_owner_info_array, [
                'date' => date('Y-m-d', strtotime($info_data->created_at)),
                
                'house_no' => $info_data->house->house_no,
                'rent_bill' => number_format($info_data->rent, 2),
                'maitenance_bill' => number_format($info_data->bills, 2),
                'remitance' => number_format($info_data->paid_in, 2),
                'commission' => number_format($commission, 2),
            ]);
            }
            else{
               array_push($property_owner_info_array, [
                'date' => date('Y-m-d', strtotime($info_data->created_at)),
                
                'house_no' => 'Apartment Bill',
                'rent_bill' => number_format($info_data->rent, 2),
                'maitenance_bill' => number_format($info_data->total_owned, 2),
                'remitance' => number_format($info_data->paid_in, 2),
                'commission' => number_format($commission, 2),
            ]);  
            }
            // dd($info_data->house->house_no);
            $commission_total += $commission;
        }
        $rent_sum = $property_owner_data->sum('rent');
        $bills_sum = $property_owner_data->where('type','!=','Rent Collection')->sum('total_owned');
        $remittance = $property_owner_data->where('type','==','Rent Collection')->sum('paid_in');
        $totals['rent'] = number_format($rent_sum, 2);
        $totals['maintenance'] = number_format($bills_sum, 2);
        $totals['remitance'] = number_format($property_owner_data->where('type','==','Rent Collection')->sum('paid_in'), 2);
        $totals['commission'] = number_format($commission_total, 2);
        $totals['sum_remitance'] = $totals['remitance'];
        $totals['sum_amount'] = number_format($rent_sum - ($commission_total + $bills_sum), 2);
        $totals['balance'] = number_format($rent_sum - ($commission_total + $bills_sum) - $remittance, 2);
        // $info['entries'] = $property_owner_info_array;
        $info['entries'] = $property_owner_info_array;
        $info['property_owner_info_array_info'] = $property_owner_info_array_info;
        $info['totals'] = $totals;
        $info['other_info'] = $this->otherInfo($owner_id, $dates, 'property_owner');

        return $info;
    }
    
    private function checkBill($payOwnerInfo){
        if($payOwnerInfo->electricty){
            return ['ELectricy Bill',$payOwnerInfo->electricty];
        }
        if($payOwnerInfo->water){
            return ['Water Bill',$payOwnerInfo->electricty]; 
        }
        if($payOwnerInfo->compound){
            return ['Compound Bill',$payOwnerInfo->compound];
        }
        if($payOwnerInfo->litter){
            return ['Litter Bill',$payOwnerInfo->litter];
        }
        if($payOwnerInfo->security){
            return ['Security Bill',$payOwnerInfo->security];
        }
        return false;
    }
    
    private function checkPayment($payOwnerInfo, $apartment_name){
        $billPayment = BillsPayment::where('MSISDN',$payOwnerInfo->id)->first();
        if( $billPayment ){
            return  ['Payment ('.$apartment_name.' '.$billPayment->bill_for .' To '. $billPayment->service_provider.')',$billPayment->TransAmount,$billPayment->payment_date,$billPayment->TransID];
        }else{
            return false;
        }
    }
    public function getAgencyData($dates)
    {

        if (count($dates) > 0) {
            $from = $dates['from'];
            $to = $dates['to'];
            $from = $this->dateFormater('d/m/Y', $from, 'Y-m-d','old');
            $to = $this->dateFormater('d/m/Y', $to, 'Y-m-d','old');
            $agencies_data = PayOwner::with('house')->where('created_at', '>=', $from)
                ->where('created_at', '<=', $to)->get();
        } else {
            $agencies_data = PayOwner::with('house')->get();
        }
        $agency_income_expense_data = [];
        $agency_expenses = AgencyExpense::where('status', 1)->get();

        $total_expense = $agency_expenses->sum('amount');

        $rent_collection_commission = 0;
        foreach ($agencies_data as $agency_data) {
            $commission = $agency_data->rent * ($agency_data->mgt / 100);
            if($agency_data->house && $agency_data->house->house_no){
            array_push($agency_income_expense_data, [
                'date' => date('Y-m-d', strtotime($agency_data->updated_at)),
                'description' => 'House-' . $agency_data->house->house_no,
                'income' => number_format($commission, 2),
                'reference' => 'Rent Collection Commission',
                'expense' => '-',
                'type' => 'Income',
            ]);

            $rent_collection_commission += $commission;
            }

        }
        foreach ($agency_expenses as $agency_expense) {
            $commission = $agency_expense->rent * ($agency_expense->mgt / 100);
            array_push($agency_income_expense_data, [
                'date' => date('Y-m-d', strtotime($agency_expense->updated_at)),
                'description' => $agency_expense->type,
                'reference' => $agency_expense->transaction_code,
                'income' => '-',
                'expense' => number_format($agency_expense->amount, 2),
                'type' => 'Expense',
            ]);
        }
        $other_incomes_totals = Income::get()->sum('amount');
        $incomes = Income::get();
        foreach ($incomes as $inc) {
            array_push($agency_income_expense_data, [
                'date' => $this->dateFormater('d/m/Y', $inc->income_date, 'Y-m-d'),
                'description' => $inc->source,
                'reference' => 'Other Income',
                'income' => number_format($inc->amount, 2),
                'expense' => '-',
                'type' => 'Income',
            ]);
        }

        $agency_income_expense_data = collect($agency_income_expense_data)->sortBy('date')->all();

        $other_info = $this->otherInfo('Agency', $dates, 'agency');

        $entries = [];
        foreach ($agency_income_expense_data as $sa) {
            array_push($entries, $sa);
        }

        $placement_fee_income = PlacementFee::get()->sum('amount');
        $info['entries'] = $entries;
        $info['other_info'] = $other_info;
        $info['total_expense'] = number_format($total_expense, 2);
        $info['rent_collection_commission'] = number_format($rent_collection_commission, 2);
        $info['placement_fee_income'] = number_format($placement_fee_income, 2);
        $info['other_incomes_totals'] = number_format($other_incomes_totals, 2);

        $incm_total_summed = array_sum([$other_incomes_totals, $placement_fee_income, $rent_collection_commission]);
        $info['income_total'] = number_format($incm_total_summed, 2);
        $info['balance'] = number_format($incm_total_summed - $total_expense, 2);
        return $info;
    }

    private function invoice_number($id)
    {
        $length = 4;
        $cur_inv = Invoice::where('id', $id)->first();
        $invoice = 'INV' . substr(str_repeat(0, $length) . $id, -$length) .' ('. $cur_inv->rent_month.')';
        return $invoice;
    }
    private function payment_reference($ref, $inv)
    {
        return 'Cash';
        // return $ref !== null ? $ref : 'Cash';
    }

    public function otherInfo($id, $dates, $typ)
    {
        $email = '';
        $acc_number = '';
        if ($typ === 'tenant') {
            $tenant = Tenant::where('id', $id)->first();
            $name = $tenant->full_name;
            $telephone = $tenant->phone;
            $acc_number = $tenant->account_number;
           

            $file_name_string = 'Member_Statement';
        }

        $date_of_statement = date('jS M Y');
        $from_to = 'All';
        if (count($dates) > 0) {
            $from = $this->dateFormater('d/m/Y', $dates['from'], 'jS M Y');
            $to = $this->dateFormater('d/m/Y', $dates['to'], 'jS M Y');
            $from_to = $from . ' to ' . $to;
            $file_name_string .= '_' . $from . '_to_' . $to;
        }
        $file_name_string .= '_' . $telephone;
        $file_name_string .= '.pdf';
        return [
            'name' => $name,
            // 'apart_name' => $apartment_name,
            'phone' => $telephone,
            'email' => $email,
            'date' => $date_of_statement,
            'from_to' => $from_to,
            'file_name' => $file_name_string,
            'acc_number' => $acc_number,
            // 'house_no' => $house_no,
            // 'apartment_name' => $apartment_name,
            // 'landlord_name' => $landlord_name,
        ];
    }

    public function sumArrayOfObjects($array, $property)
    {
        $sum = 0;
        foreach ($array as $value) {
            if (isset($value[$property]) && is_numeric($value[$property])) {
                $sum += $value[$property];
            }

        }
        return $sum;
    }

    private function dateFormater($date_format, $date, $converted_format)
    {
        return date($converted_format, strtotime($date));
    }
    
    private function cb($a, $b) {
        return strtotime($a['date']) - strtotime($b['date']);
    }
    
    private function getHouseFromTenantId($tenant_id){
       
        $house_tenant_data = HouseTenant::with('house','apartment')->where('tenant_id',$tenant_id)->first();
        if($house_tenant_data){
        $house_data = House::where('id',$house_tenant_data->house_id)->first();
        $apartment = Apartment::where('id',$house_data->apartment_id)->first();
        // dd($house_data);
        $landlord = Landlord::where('id', $apartment->landlord_id)->first();
        return [$house_data->house_no, $apartment->name, $landlord->full_name];
        }
        else{
         $house_data = 'Vacated';
        $apartment = 'No Apartment';
        // dd($house_data);
        $landlord = 'No Owner';
        return [$house_data, $apartment, $landlord];  
        }
      
       
    }

}
