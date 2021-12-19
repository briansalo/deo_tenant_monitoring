<?php

namespace App\Http\Controllers\backend\electricity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;

use App\Models\Payment;

use Itexmo;
class ElectricityPaymentController extends Controller
{

public function ElectricityPaymentAdd(){

    $data['alltenant'] = Tenant::all();

        //check first if the database is empty or not. cause in this case we are depending on database
        $check= Payment::select('or_number')->orderBy('id','DESC')->first();
        if($check == null){
                $data['or_number'] = 'null';
        }else{
                //get the or number that last save in table payment
                $OR= Payment::select('or_number')->orderBy('id','DESC')->first()->or_number;
                $data['or_number'] = $OR+1;
       }

    return view('backend.electricity.electricity_payment.electricity_payment_add', $data);
}


public function ElectricityPaymentStore(Request $request){

$validatedData = $request->validate([

        'select_name'=>'required_if:status,0|required_if:status,1',
            "from.to"    => "required_if:status,0|required_if:status,1",

]);

    if($request->select_name =="cancel"){
         $OR= Payment::select('or_number')->orderBy('id','DESC')->first()->or_number;
            $data= new Payment();
            $data->tenant_id = '0'; // number zero means cancel O.R.
            $data->billing_id = '3'; // number 3 means cancel O.R.
            $data->or_number = $OR+1;
            $data->status = $request->status;
            $data->save();
     }else{       
            $data= new Payment();
            $data->tenant_id = $request->select_name;
            $data->billing_id = '1'; // number one means electricity payment
            $data->start_date = date('Y-m-d',strtotime($request->from));
            $data->end_date = date('Y-m-d',strtotime($request->to));
            $data->or_number = $request->or_number;
            $data->status = $request->status;
            $data->save();
    }

        $notification = array(
            'message' => 'notify',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );

        return redirect()->route('electricity.payment.add')->with($notification);


}








}
