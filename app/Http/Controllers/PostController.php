<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index');
    }


    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }


    public function postLike(Request $request)
    {

        $post_id = $request->post_id;
        $chcnge_like = 0;
        $likeCheck = Like::where(['user_id'=>Auth()->id(), 'post_id'=>$post_id])->first();

        if (!$likeCheck){
            $newLike = new Like;
            $newLike->post_id = $post_id;
            $newLike->user_id = Auth()->id();
            $newLike->like =1;
            $newLike->save();

            $is_like = 1;

        }elseif ($likeCheck->like == 1){
            Like::where(['user_id'=>Auth()->id(), 'post_id'=>$post_id])->delete();
            $is_like = 0;

        }elseif ($likeCheck->like == 0){ // whene the user click the unlike button thats time  0 value insert to database
            Like::where(['user_id'=>Auth()->id(), 'post_id'=>$post_id])->update(['like'=>1]);
            $is_like = 1;
            $chcnge_like = 1;

        }


        $response = array(
            'is_like' => $is_like,
            'chcnge_like' => $chcnge_like,
        );

        return response()->json($response);


    }


    public function postDislike(Request $request){
        $post_id = $request->post_id;
        $change_dislike = 0;
        $dislikeCheck = Like::where(['user_id'=>auth()->id(), 'post_id'=>$post_id])->first();

        if (!$dislikeCheck){
            $newDislike = new Like;
            $newDislike->post_id = $post_id;
            $newDislike->user_id = auth()->id();
            $newDislike->like = 0;
            $newDislike->save();
             $is_dislike = 1;
        }elseif ($dislikeCheck->like == 1){
            Like::where(['user_id'=>auth()->id(), 'post_id'=>$post_id])->update(['like'=>0]);
            $is_dislike = 1;
            $change_dislike = 1;

        }elseif ($dislikeCheck->like == 0){
            Like::where(['user_id'=>auth()->id(), 'post_id'=>$post_id])->delete();
            $is_dislike = 0;
        }


        $response = array(
            'is_dislike' => $is_dislike,
            'change_dislike' => $change_dislike,
        );

        return response()->json($response);

    }

}
