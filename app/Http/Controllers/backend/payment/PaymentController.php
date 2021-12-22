<?php

namespace App\Http\Controllers\backend\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\Payment;

class PaymentController extends Controller
{

 public function PaymentAdd(){
    $alltenant = Tenant::all();

        $check_or= Payment::whereNotNull('or_number')->orderBy('or_number','DESC')->first();
        $check_ar= Payment::whereNotNull('ar_number')->orderBy('ar_number','DESC')->first();

        //check first if the database is empty or not. cause in this case we are depending on database
        if(empty($check_or) or empty($check_or->or_number)){
                $or_number = 'null';
        }else{
                //get the or number that last save in table payment
                $OR= Payment::whereNotNull('or_number')->orderBy('or_number','DESC')->first()->or_number;
                $or_number = $OR+1;
        }//end if

         if(empty($check_ar) or empty($check_ar->ar_number)){
                  $ar_number = 'null';
         }else{
                $AR= Payment::whereNotNull('ar_number')->orderBy('ar_number','DESC')->first()->ar_number;
                $ar_number = $AR+1;     
        }//end if

        return view('backend.Payment.payment_add', compact('alltenant','or_number', 'ar_number'));

 }

public function PaymentStore(Request $request){
    
//----------since our request month the value is only year and month and in our database the value of column month is year, month and day. so we can't validate if the month from request is already exist in our database. cause they don't have same format of date so we cant use validation here. and this is the alternative way to check if the month inputted is not duplicated each tenant---------//

//retrieve all month from request
for($i=0; $i<count($request->month); $i++){    
$month[] = date('Y-m-d', strtotime($request->month[$i])); 
}

//retrieve from database the all month that been paid for this tenant
$get_each_month=[];
$get_all_month = Payment::where('tenant_id', $request->select_name)->where('status', 0)->get();
foreach($get_all_month as $value){
    $get_each_month[]=$value->month;
}

//check if the request month is same in the month from database of the tenant 
    if(array_intersect($month, $get_each_month)){
             $notification = array(
                'message' => 'The month is already paid for this tenant, please double check your data!!!',
                'alert-type' => 'error'  //error variable came from admin.blade.php in java script toastr
             );
    }else{
           $check_or= Payment::orderBy('or_number','DESC')->first();
            $check_ar= Payment::orderBy('ar_number','DESC')->first();
            //if payment type is equal to rental or equal to deepwell
            if($request->payment_type == 1 or $request->payment_type == 3){
                //check if $check_or variable is null or the request->or_number is still available in database
                    if($check_or == null or $check_or->or_number == null or $check_or->or_number+1 == $request->or_number){
                    
                            for($i=0; $i<count($request->month); $i++){
                                  $data= new Payment();
                                  $data->tenant_id = $request->select_name;
                                  $data->billing_id = $request->payment_type;
                                  //check if the status is not cancel 
                                  if($request->status!=2){ 
                                          if($request->payment_type == 1){ 
                                              $data->month = date('Y-m-d',strtotime($request->month[$i])); //for rental
                                          }else{
                                              $data->start_date = date('Y-m-d',strtotime($request->from_water));//for deepwell
                                              $data->end_date = date('Y-m-d',strtotime($request->to_water));//for deepwell  
                                          }
                                    }
                                  $data->or_number = $request->or_number;
                                  $data->status = $request->status;
                                  $data->save();
                            }

                              $notification = array(
                                'message' => 'Payment Inserted Successfully',
                                'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
                              );
        

                    }else{
                            $notification = array(
                                'message' => 'Failed to insert in database. please try again!!!',
                                'alert-type' => 'error'  //error variable came from admin.blade.php in java script toastr
                            );
                    }//END IF
            }//END IF of payment type

            //if payment type is equal to electric
            if($request->payment_type == 2){
                //check if $check_or variable is null or the request->or_number is still available in database
                    if($check_ar == null or $check_ar->ar_number == null or $check_ar->ar_number+1 == $request->ar_number){
            
                              $data= new Payment();
                              $data->tenant_id = $request->select_name;
                              $data->billing_id = $request->payment_type; 
                              //check if the status is not cancel
                              if($request->status!=2){ 
                                  $data->start_date = date('Y-m-d',strtotime($request->from));//for electricity
                                  $data->end_date = date('Y-m-d',strtotime($request->to));//for electricity
                              }
                              $data->ar_number = $request->ar_number;
                              $data->status = $request->status;
                              $data->save();

                              $notification = array(
                                'message' => 'Payment Inserted Successfully',
                                'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
                              );

                    }else{
                            $notification = array(
                                'message' => 'Failed to insert in database. please try again!!!',
                                'alert-type' => 'error'  //error variable came from admin.blade.php in java script toastr
                            );
                    }//END IF
            }//END IF payment type
    }//end if of array intersect
        return redirect()->route('payment.add')->with($notification);   

 }//end paymentstore function



}//END CLASS
