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

</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center text-success">ItSolutionStuff.com</h3>
                        <br/>
                        <h2>{{ $post->title }}</h2>
                        <p>
                            {{ $post->body }}
                        </p>
                        <hr />
                        <div class="row">

                            <div class="col-sm-4 text-center postLikeUnlike">
                                <p>
                                    <a class="btn btn-sm attrActice like"><i class="fa fa-thumbs-up fa-sm"></i> <span style="font-size: medium">Like <span>10</span> </span></a>
                                    <a class="btn btn-sm unlike"><i class="fa fa-thumbs-down"></i> <span style="font-size: medium">Unlike <span>5</span> </span> </a>
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

    <script>
       $(document).ready(function(){


            $(".CommentReplay").on('click', '.singleCommentReply', function () {
                var comment_id = $(this).data('id');
                var id = $("input[name='parent_id']").val();
                    alert(id);
                   /*$(".replayFormHidden").toggle();*/
            });

        });



    </script>

@endsection
