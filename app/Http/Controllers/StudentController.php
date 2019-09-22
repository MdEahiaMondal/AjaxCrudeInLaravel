<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students');
    }

    public function allStudent(){

        $all_student = Student::all();
        return DataTables::of($all_student)
            ->addColumn('action', function ($all_student){

                $btn = "<a onclick='editStudent(".$all_student->id.")' class='btn btn-sm btn-primary'>Edit</a>";

                $btn = $btn."<a onclick='deleteStudent(".$all_student->id.")' class='btn btn-sm btn-danger'>delete</a>";

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data =[
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'religion' => $request->religion,
            'avatar' => $request->avatar,
        ];
        $originalImage= $request->file('avatar');
        if ($originalImage){
            $getImageExtension = $originalImage->getClientOriginalExtension();
            $randomName = Str::random(40);
            $finaliImageName = $randomName.'.'.$getImageExtension;
            $finalDir = public_path('Avatar/'.$finaliImageName);
            Image::make($originalImage)->resize(150,150)->save($finalDir);
            $data['avatar'] = $finaliImageName;
             Student::create($data);
             return "successufully Done!!";
        }else{
            Student::create($data);
            return "successufully Done!!";
        }

        /*$thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/thumbnail/';
        $originalPath = public_path().'/images/';
        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150,150);
        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName());

        $imagemodel->save();

        return back()->with('success', 'Your images has been successfully Upload');*/



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
