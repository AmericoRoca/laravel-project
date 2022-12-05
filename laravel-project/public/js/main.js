var url = 'http://localhost/laravel-project/laravel-project/public';

window.addEventListener("load", function(){

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    function like(){
         //like button
        $('.btn-like').unbind('click').click(function(){
            console.log('like');
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-comrads-orange.png');

            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('like en la publicacion');
                    } else {
                        console.log('error like en la publicacion');
                    }
                    
                }
            });

            dislike();
        });

    }
    like();
    
    function dislike(){
        //dislike button
        $('.btn-dislike').unbind('click').click(function(){
            console.log('dislike');
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/heart-comrads-black.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success: function(response){
                    if(response.like){
                        console.log('dislike en la publicacion');
                    } else {
                        console.log('error dislike en la publicacion');
                    }
                    
                }
            });

            like();
        });
    }
    dislike();
     
});