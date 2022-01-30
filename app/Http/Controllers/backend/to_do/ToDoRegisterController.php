<?php

namespace App\Http\Controllers\backend\to_do;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\todo;



class ToDoRegisterController extends Controller
{
    public function TodoView(){

        $data['alldata'] = todo::all();

        return view('backend.todo.todo_view', $data);

    }

    public function TodoAdd(){

        return view('backend.todo.todo_add');

    }


    public function TodoStore(Request $request){

            $data = new todo();
            $data->task = $request->task;
            $data->save();
                
            $notification = array(
                'message' => 'New To Do Inserted Successfully',
                'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
            );


            return redirect()->route('to_do.view')->with($notification);

    }

    public function TodoDelete($tenant_id){
            $data = todo::find($tenant_id);
            $data->delete();

            $notification = array(
                'message' => 'To Do Completed Successfully',
                'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
            );
            return redirect()->route('to_do.view')->with($notification);
    }

}
