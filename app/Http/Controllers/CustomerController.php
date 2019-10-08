<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function getIndex()
    {
        return view('customer_24learn.index');
    }

    public function getData()
    {
       return Customer::all();

    }

    public function postStore(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email:customers',
            'phone' => 'required|numeric',
       ]);


        if ($validate){
            Customer::create($request->all());
            return ['success'=>true, 'message'=>'Inserted succefully!'];
        }else{
            return response()->json(['error'=>$validate->errors()->all()]);
        }


    }

    public function postUpdate(Request $request)
    {
        if($request->has('id')){
            Customer::find($request->input('id'))->update($request->all());
            return ['success'=>true, 'message'=>'Updated successfully!'];
        }
    }


    public function postDelete(Request $request)
    {
        if ($request->has('id')){
            Customer::find($request->input('id'))->delete();
            return ['success'=>true, 'message'=>'Deleted successfully!'];

        }

    }

}
