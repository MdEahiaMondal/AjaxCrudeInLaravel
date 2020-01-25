<?php

namespace App\Http\Controllers;

use App\Country;
use App\Country_state_city;
use App\District;
use App\Division;
use App\Union;
use App\Upazila;
use App\Village;
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




    //now we create defarent  idea part2.........
    public function Dynamicfieldpart2(){
        $allCountry = Country::all();
        return view('dynamicDepandent.dynamic_select_field_part2', compact('allCountry'));
    }

    public function fieldItem(Request $request){
        $options_id = $request->get('options_id');
        $selectFieldNameOrId = $request->get('selectFieldNameOrId');

            if ($selectFieldNameOrId == 'countries'){
                $allDivision = Division::where('country_id',$options_id)->get(); // its array

                $output = '';
                foreach ($allDivision as $division){
                    $output .= '<option value="'.$division->id.'">'.$division->name.'</option>';
                }
                return $output;
            }


            if ($selectFieldNameOrId == 'divisions'){
                $allDistrict = District::where('division_id',$options_id)->get(); // its array

                $output = '';
                foreach ($allDistrict as $District){
                    $output .= '<option value="'.$District->id.'">'.$District->name.'</option>';
                }
                return $output;
            }


           if ($selectFieldNameOrId == 'districtes'){
                $allUpazila = Upazila::where('district_id',$options_id)->get(); // its array

                $output = '';
                foreach ($allUpazila as $Upazila){
                    $output .= '<option value="'.$Upazila->id.'">'.$Upazila->name.'</option>';
                }
                return $output;
            }

          if ($selectFieldNameOrId == 'upazilas'){
                $allDivision = Union::where('upazila_id',$options_id)->get(); // its array

                $output = '';
                foreach ($allDivision as $division){
                    $output .= '<option value="'.$division->id.'">'.$division->name.'</option>';
                }
                return $output;
            }

          if ($selectFieldNameOrId == 'unions'){
                $allVillage = Village::where('union_id',$options_id)->get(); // its array

                $output = '';
                foreach ($allVillage as $village){
                    $output .= '<option value="'.$village->id.'">'.$village->name.'</option>';
                }
                return $output;
            }


    }


    public function dynamicInputFieldWithValue()
    {
        return view('add_dynamicField_By_inputValue.dynamic_with_input_value');
    }





}
