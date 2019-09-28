<?php

namespace App\Http\Controllers;

use App\DynamicField;
use Validator;
use http\Env\Response;
use Illuminate\Http\Request;

class DynamicFieldController extends Controller
{
    public function showForm(){
        return view('dynamicField.dynamic_field');
    }


    public function insert(Request $request){
        $validator = \Validator::make($request->all(), [
            'first_name.*' => 'required',
            'last_name.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }

        $first_name = $request->first_name;
        $last_name = $request->last_name;

        for ($count = 0; $count < count($first_name); $count++){
            $data = array(
                'first_name' => $first_name[$count],
                'last_name' => $last_name[$count],
            );
            $inset_data[] = $data;
        }

        DynamicField::insert($inset_data);
        return \response()->json([
            'success' => "Data Added Successfully !",
        ]);


      /*  if ($request->ajax()){
            $rules = array([
                'first_name.*' => 'required',
                'last_name.*' => 'required'
            ]);
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()){
                return response()->json([
                    'error' => $error->errors()->all()
                ]);
            }

            $first_name = $request->first_name;
            $last_name = $request->last_name;

            for ($count = 0; $count < count($first_name); $count++){
                $data = array(
                    'first_name' => $first_name[$count],
                    'last_name' => $last_name[$count],
                );
                $inset_data[] = $data;
            }

            DynamicField::insert($inset_data);
            return \response()->json([
                'success' => "Data Added Successfully !",
            ]);

        }*/
}




}
