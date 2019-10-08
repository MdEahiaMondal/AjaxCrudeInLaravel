<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class LiveSearchController extends Controller
{
    public function index(){
        return view('liveSearch.live_search');
    }

    public function action(Request $request)
    {
        if ($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if ($query != '')
            {
                $data = Customer::where('name','like','%'.$query."%")
                    ->orWhere('email','like','%'.$query.'%')
                    ->orWhere('phone', 'like', '%'.$query.'%')
                    ->orderBy('id','desc')
                    ->get();
            }
            else
            {
              $data = Customer::orderBy('id','desc')->get();
            }

            $total_row = $data->count();

            if ($total_row > 0){
               foreach ($data as $row){
                   $output .='<tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->name.'</td>
                                <td>'.$row->email.'</td>
                                <td>'.$row->phone.'</td>
                            </tr>';
               }
            }else{
                $output = '<tr>
                                <td align="center" colspan="5">No Data Found</td>
                           </tr>';
            }

            $data = array(
                'table_data' => $output,
                'total_data' => $total_row,
            );

            echo json_encode($data);

        }
    }



}
