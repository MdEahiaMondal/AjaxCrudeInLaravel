<?php

namespace App\Http\Controllers;

use App\Country_state_city;
use Illuminate\Http\Request;

class DynamicDependentController extends Controller
{

    public function index(){
        $allCountry = Country_state_city::groupBy('country')->get();
        return view('dynamicDepandent.dynamic_dpendent', compact('allCountry'));
    }

    public function fetch(Request $request){
        $selectFieldNameOrId = $request->get('selectFieldNameOrId');
        $OpValue = $request->get('OpValue');
        $dependent = $request->get('dependent');

        // now get data
        $data = Country_state_city::where($selectFieldNameOrId, $OpValue)->groupBy($dependent)->get();
        $output = '<option value="">Select '. ucfirst($dependent) .'</option>'; /*this line like this one   ( <option value="">Select City</option>)  */

        foreach ($data as $row){
            $output .= '<option value="' .$row->$dependent. '">'.$row->$dependent.'</option>';
        }

        return $output;

    }

}
