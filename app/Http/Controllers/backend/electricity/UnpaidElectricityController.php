<?php

namespace App\Http\Controllers\backend\electricity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;


use App\Models\Payment;
use App\Models\Tenant;

class UnpaidElectricityController extends Controller
{

      public function UnpaidElectricityView(){
              
                  $get_latest_date = [];
                  
                 //i use join here cause we need to retrieve data from payment table for those tenant status is active in tenant table
                 //for more explanation in join table heres the link https://www.youtube.com/watch?v=wkNkgkFePTg
                   $alldata = Payment::join('tenants','payments.tenant_id','=','tenants.id')
                        ->where('tenants.status',1)
                        ->where('payments.billing_id',2)
                        ->where('payments.status', 0)
                        ->select('payments.tenant_id')
                        ->groupBy('payments.tenant_id')
                        ->get();

                 foreach($alldata as $row){

                      $latest_date = payment::where('tenant_id', $row->tenant_id)
                      ->where('billing_id', '2')
                      ->where('status', '0')
                      ->orderby('end_date', 'desc')
                      ->first();

                      $get_latest_date[] = $latest_date->end_date;
                 }
                  

               return view('backend.electricity.unpaid_electricity_view')->with('alldata', $alldata)->with('get_latest_date', $get_latest_date);
      }





}
