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

        $today= Carbon::now();
        
            $get_latest_date = [];

            $alldata = Payment::select('tenant_id')
            ->groupBy('tenant_id')
            ->where('billing_id', '1')
            ->get();

           foreach($alldata as $row){

                $latest_date = payment::where('tenant_id', $row->tenant_id)
                ->where('billing_id', '1')
                ->orderby('end_date', 'desc')
                ->first();

                $get_latest_date[] = $latest_date->end_date;
                


           }
          // dd($get_latest_date);

            

         return view('backend.electricity.unpaid_electricity.unpaid_electricity_view')->with('alldata', $alldata)->with('get_latest_date', $get_latest_date);
}





}
