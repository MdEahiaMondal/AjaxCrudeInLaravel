<?php

namespace App\Http\Controllers;

use App\Profile;
use Validator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;

class ProfileController extends Controller
{
    public function index(){

        if (request()->ajax()){// if come to reguest with ajax
            return DataTables::of(Profile::latest()->get())
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    $btn = '<button type="button" name="edit" id="'. $row->id .'" class="edit btn btn-sm btn-primary">Edit</button>';
                    $btn .='&nbsp;&nbsp';
                    $btn .= '<button type="button" name="delete" id="'. $row->id .'" class="delete btn btn-sm btn-danger">Delete</button>';
                    return $btn;

                })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('profileAjaxCrude.index');
    }

    public function store(Request $request){
            $roules = array(
                'first_name' => 'required',
                'last_name' => 'required',
                'profile_image' => 'required|image|max:2048',
            );

            $error = Validator::make($request->all(), $roules);
            if ($error->fails()){
                return response()->json(['errors' => $error->errors()->all()]);
            }

            $image = $request->file('profile_image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
        Image:: make($image)->resize(400,450)->save(base_path('public/images/profiles/'.$new_name),100);
        $value = array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'image' => $new_name,
        );

        Profile::create($value);
        return response()->json(['success'=>'Successfully Done !']);
    }


    public function edit($id){
        if (\request()->ajax()){
            $data = Profile::findOrFail($id);// only use index id
            return response()->json(['data'=>$data]);
        }
    }



}
