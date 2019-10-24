$("#like").on('click', function () {
    var post_id = $(this).data('postid');
    post_id = post_id.slice(0, -2);
    $.ajax({
        url: likeUrl,
        method: "POST",
        data:{
          post_id: post_id,
          _token: token,
        },
        dataType: "JSON",
        success: function (feedBackResult) {

            if (feedBackResult.is_like == 1){
                var likeCount = $("*[data-postid=" + post_id +'_l'+"]").find('.LikeCount').text();
                var newLikeCount = parseInt(likeCount) + 1;
                $("*[data-postid=" + post_id +'_l'+"]").find('.LikeCount').text(newLikeCount);

                if (feedBackResult.chcnge_like == 1){
                    var dislikeCount = $("*[data-postid=" + post_id +'_d'+"]").find('.dislikeCount').text();
                    var newdisLikeCount = parseInt(dislikeCount) - 1;
                    $("*[data-postid=" + post_id +'_d'+"]").find('.dislikeCount').text(newdisLikeCount);
                }



                $("*[data-postid=" + post_id +'_d'+"]").removeClass('attrActice').addClass('btn-secondary');
                $("*[data-postid=" + post_id +'_l'+"]").removeClass('btn-secondary').addClass('attrActice');
            }

            if (feedBackResult.is_like == 0){
                var likeCount = $("*[data-postid=" + post_id +'_l'+"]").find('.LikeCount').text();
                var newLikeCount = parseInt(likeCount) - 1;
                $("*[data-postid=" + post_id +'_l'+"]").find('.LikeCount').text(newLikeCount);


                $("*[data-postid=" + post_id +'_l'+"]").removeClass('attrActice').addClass(' btn-secondary');
            }

        }
    })



});


// now whene click the dislike button then its work
$("#dislike").on('click', function () {
    var post_id = $(this).data('postid');
    post_id = post_id.slice(0, -2); // its remove last two charector (_d or _l)
    $.ajax({
        url: disLikeUrl,
        method: "POST",
        data:{
            post_id: post_id,
            _token: token,
        },
        dataType: "JSON",
        success: function (feedBackResult) {

            if (feedBackResult.is_dislike == 1){
                var dislikeCount = $("*[data-postid=" + post_id +'_d'+"]").find('.dislikeCount').text();
                var newdisLikeCount = parseInt(dislikeCount) + 1;
                $("*[data-postid=" + post_id +'_d'+"]").find('.dislikeCount').text(newdisLikeCount);


                if (feedBackResult.change_dislike == 1){
                    var likeCount =  $("*[data-postid=" + post_id + '_l'+"]").find('.LikeCount').text();
                    var newLikeCount = parseInt(likeCount) - 1;
                    $("*[data-postid=" + post_id + '_l'+"]").find('.LikeCount').text(newLikeCount);
                }


                $("*[data-postid=" + post_id +'_l'+"]").removeClass('attrActice').addClass('btn-secondary');
                $("*[data-postid=" + post_id +'_d'+"]").removeClass('btn-secondary').addClass('attrActice');
            }

            if (feedBackResult.is_dislike == 0){

                var dislikeCount =  $("*[data-postid=" + post_id + '_d'+"]").find('.dislikeCount').text();
                var newdisLikeCount = parseInt(dislikeCount) - 1;
                $("*[data-postid=" + post_id + '_d'+"]").find('.dislikeCount').text(newdisLikeCount);


                $("*[data-postid=" + post_id +'_d'+"]").removeClass('attrActice').addClass(' btn-secondary');
            }

        }
    })



});
