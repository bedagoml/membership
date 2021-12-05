<?php

namespace App\Http\Controllers;
use PDF;
use App\Receipt;
use App\House;
use App\HouseTenant;
use App\Apartment;

use Illuminate\Http\Request;

class ReceiptsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
   

    public function receipts(Request $request, $id)
    {
        $receipt = Receipt::where('id',$id)->first();
        $receipt_number = 'RE'.str_pad($receipt->id, 4, '0', STR_PAD_LEFT);
        
        
        $house_tenant = HouseTenant::where('tenant_id',$receipt->tenant_id)->first();
        if(!$house_tenant){
            $num = 50;
            $house_tenant = HouseTenant::where('tenant_id',$num)->first();
        }else{
            $num = $receipt->tenant_id;
        }
        // dd($house_tenant);
        $house = House::where('id',$house_tenant->house_id)->first();
        $apartment = Apartment::where('id',$house->apartment_id)->first();
        
        $table_data = $receipt;
        
        $data = [
          'receipt_number'=>$receipt_number,
          'receipt_data'=>$receipt,
          'house_number'=>$house->house_no,
          'property'=>$apartment->name,
          'property_type'=>$house->house_type,
          'gen_date'=>date("F j, Y, g:i a"),
        ];
        
        $pdf = PDF::loadView('receipt.index',$data);
        $pdf->setPaper('A5', 'landscape');
                return $pdf->stream('Receipt #'.$receipt_number.'.pdf');
    }

   
   

}
