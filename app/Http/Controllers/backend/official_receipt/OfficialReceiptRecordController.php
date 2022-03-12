<?php

namespace App\Http\Controllers\backend\official_receipt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Tenant;


class OfficialReceiptRecordController extends Controller
{

     public function OfficialReceiptView(){

            $data['allrecord'] = Payment::whereNotNull('or_number')->get();

             return view('backend.Official_receipt.officialreceipt_view', $data);
     }


     public function OfficialReceiptEdit($or_number){
        
           $data['alltenant'] = Tenant::all();

           $data['official_receipt'] = Payment::where('or_number',$or_number)->get();

           return view('backend.Official_receipt.officialreceipt_edit', $data);
     }


    public function OfficialReceiptUpdate(Request $request, $or_number){
        
         if($request->payment_type == 1){
               $count = count($request->month);
         }else{
               $count = 1;
         }

                Payment::where('or_number', $or_number)->delete();
                    for($i=0; $i<$count; $i++){
                                
                        $data=  new Payment();
                        $data->tenant_id = $request->select_name;
                        $data->billing_id = $request->payment_type;
                            //if status is cancel then null the month and start end column in database
                        if($request->status!=2){ 
                            if($request->payment_type == 1){
                                $data->month = date('Y-m-d',strtotime($request->month[$i]));//for rental
                             }elseif($request->payment_type == 3){        
                                $data->start_date = date('Y-m-d',strtotime($request->from));//for electricity
                                $data->end_date = date('Y-m-d',strtotime($request->to));//for electricity
                             }else{
                                $data->details = $request->details_other;
                             }
                        }
                        $data->or_number = $request->or_number;
                        $data->status = $request->status;
                        $data->save();
                   }//end for

                   $notification = array(
                       'message' => 'Payment Updated Successfully',
                        'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
                    );

                    return redirect()->route('official.receipt.view')->with($notification);

    }
}
