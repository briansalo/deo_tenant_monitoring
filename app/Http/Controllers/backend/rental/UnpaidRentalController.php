<?php

namespace App\Http\Controllers\backend\rental;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Tenant;
use App\Models\UnpaidRental;

use Carbon\Carbon;
use Carbon\CarbonPeriod;


class UnpaidRentalController extends Controller
{

public function UnpaidRentalView(){

        $today = Carbon::now();
       $addmonthtoday = $today->addMonth();
       
       $newtoday = Carbon::now(); // i create new carbon of today because the $today variable is adding a month now. because of variable $addmonthtoday

    //--------- check if there is missing month that need to pay base from first pay of the tenant up to this month -----------///
       $lastresult = [];
       $get_tenant=[];

            $alldata = Payment::select('tenant_id')
            ->groupBy('tenant_id')
            ->where('billing_id', '1')
            ->where('status', '0')
            ->get();
            
       foreach($alldata as $row){

               // this is all the firstdate of paying of all tenant
             $first_date = payment::where('tenant_id', $row->tenant_id)
             ->where('billing_id', '1')
             ->where('status', '0')
             ->orderby('month', 'asc')
             ->first();

             // i use wherebetween here in able to limit the maximum month which is only this current month.  incase if the tenant pay in advance then we dont have a problem
             $database = payment::where('tenant_id', $row->tenant_id)
                  ->whereBetween('month', [$first_date->month, $newtoday])
                  ->where('billing_id','1')
                  ->where('status', '0')
                  ->get(); 

              $first = Carbon::create($first_date->month);

             $months_diff = $first->diffInMonths($addmonthtoday); // in diffinmonths start count in the next month of $first variable. i use variable $addmonthtoday to get my exact counting 
           
             //check if the month from the start of paying up to this month is euqal to the pay in variable $database 
            if($months_diff != count($database)){

                    //get the tenant that having missing month to pay
                    $get_tenant[] = $row->tenant_id;

                  ///---------------------get the date of first paying of tenant up to this month---------------------//
                    $list = [];
                    
                    $result = CarbonPeriod::create($first, '1 month', $newtoday); // i use $newtoday variable instead of $today variable because $today variable is adding month now because of $months_diff variable 

                     foreach ($result as $dt){         
                        $list[]= $dt->format('F'); // format in month because we are only based on month
                     }

                    $month=[];

                        //--------------------------get all the date of paying --------------------------------------//
                    foreach($database as $row){
                        $month[]= carbon::create($row->month)->format('F');
                    }

    //---------- get all the value from variable $list and variable $month and then retrieve only the unmatch value-------------//
                    $lastresult[] = array_diff($list, $month);
            
            }// end if

        }// end for each

            //retrieve the tenant that having missing month to pay
            $retrieve = Payment::select('tenant_id')
            ->groupBy('tenant_id')
            ->whereIn('tenant_id', $get_tenant)
            ->get();


            $merge=[];
            for($i=0; $i<count($lastresult); $i++){
                 $merge[] = array_merge($lastresult[$i]); // the $lastresult variable the ouput of this array the number is not arrange that's why i use array merge to assort the number. just try to die dump the $lastresult for more clear info
            }




///------------insert to the databasefor those tenant unpaid for their rental so we can easy to compute the penalty----------------///

        foreach($retrieve as $key => $row){

                $tenant = UnpaidRental::where('tenant_id', $row->tenant_id)->get();

                if($tenant->isEmpty()){ //it can help to avoid error if the tenant not yet in database

                        //i use for loop again since tenant can have one or more month that unpaid for their bills 
                        foreach($merge[$key] as $secondkey =>$rowsecond){
                            $unpaid = new UnpaidRental();
                            $unpaid->tenant_id = $row->tenant_id;
                            $unpaid->month = date('Y-m-d',strtotime($merge[$key][$secondkey]));
                            $unpaid->save();
                            }
                        
                }else{
                        // if the tenant is already in database. delete all record and insert new record to avoid error
                        UnpaidRental::where('tenant_id', $row->tenant_id)->delete();

                         //i use for loop again since tenant can have one or more month that unpaid for their bills
                        foreach($merge[$key] as $secondkey =>$rowsecond){
                            $unpaid = new UnpaidRental();
                            $unpaid->tenant_id = $row->tenant_id;
                            $unpaid->month = date('Y-m-01',strtotime($merge[$key][$secondkey]));
                            $unpaid->save();

                            }
                }

          }//end for loop

     return view('backend.rental.unpaid_rental_view')->with('retrieve', $retrieve)->with('merge', $merge);
     
}




public function UnpaidRentalComputePenalty(Request $request){


        $output[] = '';
        $name[0] = '';

        $penalty = UnpaidRental::where('tenant_id', $request->id)->get();
        //        dd($penalty);

            foreach($penalty as $row){
                $tenant = Tenant::where('id', $request->id)->first();
                $name[0]= $tenant->name;

                  //////////////computation ////////////
                 $today = Carbon::now();
                 $month = new Carbon($row->month);
                 
                 $fifth_day = $month->firstOfMonth()->addDays(4);

                 $per_day = 75;

                 $diff = $today->diffInDays($fifth_day);

                 $total = $diff*$per_day;

                    $output[]= '
                    <tr>
                    
                        <td style="color: white">'. carbon::create($row->month)->format('F').'</td>
                        <td style="color: white">'. $per_day." per day".'</td>
                        <td style="color: white">'. $diff. "days".'</td>
                        <td style="color: white">'. "₱".number_format($total,).'</td>
                        
                     </tr>
                    ';
                            

                }  //end for each

               

            $data = array('table_data' =>$output,
                            'tenant_name' => $name

        );  
            echo json_encode($data);
            

}




}
