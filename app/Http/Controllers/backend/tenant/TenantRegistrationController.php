<?php

namespace App\Http\Controllers\backend\tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tenant;

class TenantRegistrationController extends Controller
{


    public function TenantView(){

             $alldata = Tenant::all();
            return view('backend.tenant.tenant_view', compact('alldata'));
    }

    public function TenantAdd(){

            return view('backend.tenant.tenant_add');
    }

    public function TenantStore(Request $request){

            $data = new Tenant();
            $data->name = $request->name;
            $data->save();
                
            $notification = array(
                'message' => 'Tenant Registered Successfully',
                'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
            );
            return redirect()->route('tenant.view')->with($notification);
    }


    public function TenantEdit($tenant_id){

            $data = Tenant::find($tenant_id);
            return view('backend.tenant.tenant_registration.tenant_edit', compact('data'));
    }


    public function TenantUpdate(Request $request, $tenant_id){
          $data = Tenant::find($tenant_id);
          $data->name = $request->name;
          $data->save();

          $notification = array(
                'message' => 'Tenant Updated Successfully',
                'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
            );
           return redirect()->route('tenant.view')->with($notification);
    }

    public function TenantDelete($tenant_id){

          $data = Tenant::find($tenant_id);
          $data->delete();

          $notification = array(
                'message' => 'Tenant Deleted Successfully',
                'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
            );
           return redirect()->route('tenant.view')->with($notification);
    }

}//end class
