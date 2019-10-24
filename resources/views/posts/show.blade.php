@extends('layouts.master')
@section('contents')


    <style>
        .comment:hover {
            background-color: #e4e4e4;
        }
        .comment{
            height:35px;
        }

        .comment p{
            font-size: medium;
        }

        .postLikeUnlike .like:hover{
            background-color: #e4e4e4;
        }
        .postLikeUnlike .unlike:hover{
            background-color: #e4e4e4;
        }
        .attrActice{
            background: #e46094;
            color: white!important;
        }
        hr{
         margin-top: 0!important;
        }
        .replayLike:hover{
            background-color: #e4e4e4;
        }
        .replayFormHidden{
            display: none;
        }
        .user-comment-box {
            display: none;
        }

</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center text-success">ItSolutionStuff.com</h3>
                        <br/>
                        <h2>{{ $post->title }}</h2>
                        <p class="commentText">
                            {{ $post->body }}
                        </p>
                        <hr />

                       {{-- @php
                            $likeCount = 0;
                            $dislikeCount = 0;
                        $likeStatus = "btn-secondary";
                        $dislikeStatus = "btn-secondary";
                        @endphp

                        @foreach($post->like as $LIKE)

                            @php
                                if($LIKE->like == 1){
                                    $likeCount++;
                                }

                            if ($LIKE->like == 0){
                                    $dislikeCount++;
                                }


                            if (Auth::check()){
                                if ($LIKE->like == 1 && $LIKE->user_id == Auth()->id()){
                                    $likeStatus = "attrActice";
                                }

                                if ($LIKE->like == 0 && $LIKE->user_id == Auth()->id()){
                                    $dislikeStatus = "btn btn-danger";
                                }
                            }

                            @endphp


                        @endforeach

--}}


                        @php

                            $likeCount = 0;
                            $dislikeCount = 0;

                        $likeButton = "btn-secondary";
                        $disLikeButton = "btn-secondary";
                        @endphp

                        @foreach($post->like as $singLike)

                            @php
                                if ($singLike->like ==1){
                                    $likeCount++;
                                }

                                if ($singLike->like == 0){
                                    $dislikeCount++;
                                }

                            if(auth()->check()){
                                if ($singLike->like == 1 && $singLike->user_id == Auth()->id()){
                                    $likeButton = "attrActice";
                                }
                                if ($singLike->like == 0 && $singLike->user_id == Auth()->id()){
                                    $disLikeButton = "attrActice";
                                }
                            }

                            @endphp

                         @endforeach



                        <div class="row">
                            <div class="col-sm-4 text-center postLikeUnlike">
                                <p>
                                    <a id="like" class="btn btn-sm {{ $likeButton }}" data-postid="{{ $post->id }}_l">
                                        <i class="fa fa-thumbs-up fa-sm"></i> <span style="font-size: medium">Like <span class="LikeCount"> {{ $likeCount }} </span> </span>
                                    </a>
                                    <a id="dislike"  class="btn btn-sm {{ $disLikeButton }}" data-postid="{{ $post->id }}_d">
                                        <i class="fa fa-thumbs-down"></i> <span style="font-size: medium">Unlike <span class="dislikeCount"> {{ $dislikeCount }} </span> </span>
                                    </a>
                                </p>
                            </div>

                            <div class="col-sm-4 text-center btn btn-sm comment">
                                <p>Comments</p>
                            </div>

                            <div class="col-sm-4 text-center btn btn-sm comment">
                                <p>Share</p>
                            </div>
                        </div>
                        <hr>



                        @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])


                        <hr class="top0"/>
                        <h4>Add comment</h4>
                        <form method="post" action="{{ route('comments.store'   ) }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Add Comment" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')

    {{--// like and unlike for post --}}
    <script>
        var likeUrl = "{{ route('post.like') }}";
        var disLikeUrl = "{{ route('post.dislike') }}";
        var token = "{{ Session::token() }}";
    </script>
<script src="{{ asset('customJs/like.js') }}"></script> {{--// for tree view--}}



    <script>
       $(document).ready(function(){

           // start only text show more and less
           var commentText = $('.commentText').text(); // it's take all text
           if(commentText.length < 100) return; // if charecter less then 100 it will not work

           $(".commentText").html( // append this tag after 100 charecter
               commentText.slice(0,300)+'<span>... </span><a href="#"  class="more CommentMore">More</a>'+
               '<span class="hidden" style="display:none;">'+ commentText.slice(100,commentText.length)+' <a href="#" class="less CommentMore">Less</a></span>'
           );

           $(this).find('.CommentMore').click(function() {
               if ( $(this).is('.more') ) {
                   $(".commentText").find('.hidden').show();
                   $(".commentText").find('.more').hide();
               } else if ( $(this).is('.less') ) {
                   $('.commentText').find('.hidden').hide();
                   $('.commentText').find('.more').show();
               }
           });
           // close only text show more and less


           $(function() {
               $(".comment-box").each(function(index) {
                   $(this).children(".user-comment-box").slice(-2).show();
               });


               $(".see-more").click(function(e) {
                   e.preventDefault();
                   var $link = $(this);
                   var $div = $link.closest('.comment-box');

                   if ($link.hasClass('visible')) {
                       $link.text('Show all comments');
                       $div.children(".user-comment-box").slice(0, -2).slideUp()
                   } else {
                       $link.text('Show less comments');
                       $div.children(".user-comment-box").slideDown();
                   }

                   $link.toggleClass('visible');
               });
           });






        });



    </script>

@endsection
