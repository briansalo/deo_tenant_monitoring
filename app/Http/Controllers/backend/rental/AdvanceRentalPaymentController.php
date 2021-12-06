<?php

namespace App\Http\Controllers\backend\rental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\Payment;

class AdvanceRentalPaymentController extends Controller
{

public function AdvanceRentalPaymentAdd(){

        $data['alltenant'] = Tenant::all();
        return view('backend.rental.advance_payment.advance_payment_add', $data);
}


public function AdvanceRentalPaymentStore(Request $request){
        //dd(count($request->month));

        for($i=0; $i<count($request->month); $i++){

        $data= new Payment();
        $data->tenant_id = $request->select_name;
        $data->billing_id = '0'; // number zero means rental payment
        $data->month = date('Y-m-d',strtotime($request->month[$i]));
        $data->or_number = $request->or_number;
        $data->status = '0';
        $data->save();

        }

        $notification = array(
            'message' => 'Payment Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('advance.rental.payment.add')->with($notification);

}

}//end class
