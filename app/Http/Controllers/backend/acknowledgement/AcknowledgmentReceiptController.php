<?php

namespace App\Http\Controllers\backend\acknowledgement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Tenant;

class AcknowledgmentReceiptController extends Controller
{
    public function AcknowledgmentReceiptView(){

        $data['allrecord'] = Payment::whereNotNull('ar_number')->get();

       return view('backend.acknowledgment_receipt.acknowledge_receipt_view', $data);
    }


    public function AcknowledgmentReceiptEdit($ar_number){

            $data['alltenant'] = Tenant::all();

            $data['acknowledge_receipt'] = Payment::where('ar_number',$ar_number)->get();

            return view('backend.acknowledgment_receipt.acknowledge_receipt_edit', $data);
    }

    public function AcknowledgmentReceiptUpdate(Request $request, $ar_number){

             Payment::where('ar_number', $ar_number)->delete();

                     $data=  new Payment();
                     $data->tenant_id = $request->select_name;
                     $data->billing_id = $request->payment_type;
                     //if status is cancel then null the month and start end column in database
                      if($request->status!=2){ 
                                $data->start_date = date('Y-m-d',strtotime($request->from));//for electricity
                                $data->end_date = date('Y-m-d',strtotime($request->to));//for electricity
                        }
                        $data->ar_number = $request->ar_number;
                        $data->status = $request->status;
                        $data->save();
        

                        $notification = array(
                            'message' => 'Payment Updated Successfully',
                            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
                        );
                        return redirect()->route('acknowledge.receipt.view')->with($notification);
    }
}

