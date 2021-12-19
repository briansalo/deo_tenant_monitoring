<?php

namespace App\Http\Controllers\backend\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\Payment;

class PaymentController extends Controller
{

 public function PaymentAdd(){
    $data['alltenant'] = Tenant::all();

        $check_or= Payment::orderBy('or_number','DESC')->first();
        $check_ar= Payment::orderBy('ar_number','DESC')->first();

        //check first if the database is empty or not. cause in this case we are depending on database
        if($check_or== null or $check_or->or_number == null){
                $data['or_number'] = 'null';
        }else{
                //get the or number that last save in table payment
                $OR= Payment::select('or_number')->orderBy('or_number','DESC')->first()->or_number;
                $data['or_number'] = $OR+1;
        }//end if

         if($check_ar == null or $check_ar->ar_number == null){
                  $data['ar_number'] = 'null';
         }else{
                $AR= Payment::select('ar_number')->orderBy('ar_number','DESC')->first()->ar_number;
                $data['ar_number'] = $AR+1;     
        }//end if

        return view('backend.Payment.payment_add', $data);

 }

public function PaymentStore(Request $request){

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
        }//END IF

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
        }//END IF

        return redirect()->route('payment.add')->with($notification);    
 }



}//END CLASS
