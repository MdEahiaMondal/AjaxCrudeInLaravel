<?php

namespace App\Http\Controllers;

use App\Friend;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FriendController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()){
            $allFriends = Friend::latest()->get();
            return  DataTables::of($allFriends)
                ->addIndexColumn()
                ->addColumn('action', function ($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data_id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editFriend">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data_id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteFriend">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return  view('friends.friendAjax');
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

        Friend::create($request->all());
        return response()->json(['success'=>'Product saved successfully.']);

        /*Friend::updateOrCreate(['id' => $request->product_id],
            ['name' => $request->name, 'detail' => $request->detail]);
        return response()->json(['success'=>'Product saved successfully.']);*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }



    public function update(Request $request, $id)
    {
        $name = $request->name;
        $detail = $request->detail;
        $update = Friend::where('id',$id)->update(['name'=>$name, 'detail'=>$detail]);
        if ($update){
            return response()->json(['success'=>'Updated Successfully Done']);
        }
    }


    public function destroy(Friend $friend)
    {
          $friend->delete();
        return response()->json(['success'=>'Deleted Successfully done !']);
    }
}
