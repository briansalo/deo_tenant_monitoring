<?php

namespace App\Http\Controllers\backend\deepwell;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Tenant;

use Carbon\Carbon;
use Carbon\CarbonPeriod;


class DeepWellController extends Controller
{
    public function UnpaidDeepWellView(){

            $get_latest_month = [];
            
            //i use join here cause we need to retrieve data from payment table for those tenant status is active in tenant table
            //for more explanation in join table heres the link https://www.youtube.com/watch?v=wkNkgkFePTg
            $alldata = Payment::join('tenants','payments.tenant_id','=','tenants.id')
            ->where('tenants.status',1)
            ->where('payments.billing_id',3)
            ->where('payments.status', 0)
            ->select('payments.tenant_id')
            ->groupBy('payments.tenant_id')
            ->get();

           foreach($alldata as $row){
                $latest_date = payment::where('tenant_id', $row->tenant_id)
                ->where('billing_id', '3')
                ->where('status', '0')
                ->orderby('end_date', 'desc')
                ->first();

                $get_latest_month[] = $latest_date->end_date;
           }


           $today = Carbon::now();

           $unpaid_month=[];
           for($i=0; $i<count($get_latest_month); $i++){
                $first = Carbon::create($get_latest_month[$i]); 

                $added_month =$first->addMonth();   
                 
                 //get the month from last month of pay up to this month     
               $result = CarbonPeriod::create($added_month, '1 month', $today);
                       $list=[];
                     foreach ($result as $month){         
                        $list[]= $month->format('F Y'); // format in month because we are only based on month
                     }   

                     $unpaid_month[] = collect($list);
           }

         return view('backend.deepwell.unpaid_deepwell_view')->with('alldata', $alldata)->with('unpaid_month', $unpaid_month);

    }
}//end class
