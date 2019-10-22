<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   public function store(Request $request)
   {
       $request->validate([
           'body' => 'required',
       ]);

       $input = $request->all();
       $input['user_id'] = Auth::id();
       Comment::create($input);
       return back();
   }
}
