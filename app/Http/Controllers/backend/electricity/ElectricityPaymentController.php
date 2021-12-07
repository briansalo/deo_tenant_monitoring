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

    $OR= Payment::select('or_number')->orderBy('id','DESC')->first()->or_number;
    $data['or_number'] = $OR+1;

    return view('backend.electricity.electricity_payment.electricity_payment_add', $data);
}


public function ElectricityPaymentStore(Request $request){

    if($request->select_name =="cancel"){
         $OR= Payment::select('or_number')->orderBy('id','DESC')->first()->or_number;
            $data= new Payment();
            $data->tenant_id = '0'; // number zero means cancel O.R.
            $data->billing_id = '3'; // number 3 means cancel O.R.
            $data->or_number = $OR+1;
            $data->save();
     }else{       
            $data= new Payment();
            $data->tenant_id = $request->select_name;
            $data->billing_id = '1'; // number one means electricity payment
            $data->start_date = date('Y-m-d',strtotime($request->from));
            $data->end_date = date('Y-m-d',strtotime($request->to));
            $data->or_number = $request->or_number;
            $data->status = '0';
            $data->save();
    }

//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode,$passwd){
        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
        );
        $context  = stream_context_create($param);
        return file_get_contents($url, false, $context);
}
//##########################################################################

$number = '09153588103';

$result = itexmo($number,"Test Message","TR-BRIAN588103_S7DBN", "zte4r@83#6");
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.  
Please CONTACT US for help. ";  
}else if ($result == 0){
echo "Message Sent!";
}
else{   
echo "Error Num ". $result . " was encountered!";
}

        $notification = array(
            'message' => 'Payment Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('electricity.payment.add')->with($notification);


}








}
