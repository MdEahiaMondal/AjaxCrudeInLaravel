<?php

namespace App\Http\Controllers;


use App\Student;
use File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Image;

use Yajra\DataTables\DataTables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
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
            ->addColumn('checkbox', '<input type="checkbox" name="student_checkbox" class="student_checkbox" id="checkBox" value="{{$id}}">')
            ->rawColumns(['action', 'checkbox'])

            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


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
            return Student::create($data);
        }else{
            return Student::create($data);
        }

    }




    public function edit($id)
    {
       return Student::find($id);
    }


    public function update(Request $request, $id)
    {

       $vali = $request->validate([
            'email'  => 'required|unique:students,email,'.$id.',id',// here in this colum statment is :: when you update this column its will be compear to others column without this column if your table column id is id
            'name' => 'required',
            'phone' => 'required|unique:students,phone,'.$id.',id',
            'religion' => 'required',
        ]);

        $students = Student::find($id);
        $students->name  = $request->name;
        $students->email  = $request->email;
        $students->phone  = $request->phone;
        $students->religion  = $request->religion;

        $name = Student::find($id);
        $image_name = $name->avatar;
        $imageCheck = $request->file('avatar');
        if($imageCheck){
            // first check the old image in stor folder
            if(File::exists('Avatar/'.$image_name)){
                // delete the file
                File::delete('Avatar/'.$image_name);
            }

            // after delete the old image  so now new image upload
            $new_image_name = $request->avatar;
            $getfile_extension = $new_image_name->getClientOriginalExtension();
            $make_randomName = Str::random(40);
            $makeFileName =$make_randomName.'.'.$getfile_extension;
            $goToRightLocation =public_path('Avatar/'.$makeFileName);
            Image::make($new_image_name)->resize(150,150)->save($goToRightLocation);
            $students->avatar  = $makeFileName;
            $students->update();
            return $students;

        }else{
            // without image
            $students->update();
            return $students;
        }

    }



    public function destroy($id)
    {
        $image = Student::find($id);
        $image_name = $image->avatar;
        if($image_name){
            // first check the old image in stor folder
            if(File::exists('Avatar/'.$image_name)){
                // delete the file
                File::delete('Avatar/'.$image_name);
            }
            $delete = Student::destroy($id);
            return $delete;
        } else{
            $delete = Student::destroy($id);
            return $delete;
        }

    }


    function  CheKDelete(Request $request){
        $student_id_array = $request->input('id');

       /* $deleteStudent = Student::whereIn($student_id_array);// if come to id with arrary then use whereIn so it check one by one
        if($deleteStudent->delete()){
            echo "success";
        }*/
         foreach ($student_id_array as $value){
                 $image = Student::find($value);
                 $image_name = $image->avatar;
             if($image_name){
                 // first check the old image in stor folder
                 if(File::exists('Avatar/'.$image_name)){
                     // delete the file
                     File::delete('Avatar/'.$image_name);
                 }
                 $StudentDelete = Student::find($value);
                 if ($StudentDelete->delete()){
                     echo "success";
                 }

             }else{
                 $StudentDelete = Student::find($value);
                 if ($StudentDelete->delete()){
                     echo "success";
                 }
             }// end of if else

         }// end of foreach


    }// end of main function



}
