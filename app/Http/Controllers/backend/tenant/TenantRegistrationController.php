<?php

namespace App\Http\Controllers\backend\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\User;

use Nexmo\Laravel\Facade\Nexmo;

use App\Notifications\CustomSmsNotification;

class TenantRegistrationController extends Controller
{


public function TenantView(){

            $alldata = Tenant::all();
        return view('backend.tenant.tenant_registration.tenant_view', compact('alldata'));



    }


public function TenantEdit(Request $request){


 



            //return redirect()->route('dashboard');

}


public function TenantStore(Request $request){

$message = "hi";

\Notification::send(User::all(), new CustomSmsNotification($message));

        $data = new Tenant();
        $data->name = $request->business_name;
        $data->owner = $request->owner_name;
        $data->from = date('Y-m-d',strtotime($request->from));
        $data->to = date('Y-m-d',strtotime($request->to));
        $data->gross = $request->amount;
        $data->save();
            

         //$number = ['639989419002', '639153588103'];
        //for($i=0; $i < count($number); $i++){
        //Nexmo::message()->send([
          //  'to' => $number[$i],
            //'from' => '639153588103',
            //'text' => 'for loop nexmo'
        //]);

        //}

        $notification = array(
            'message' => 'Tenant Register Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('dashboard')->with($notification);

    }


}
