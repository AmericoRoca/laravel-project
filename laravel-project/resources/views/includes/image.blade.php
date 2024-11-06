<div class="card pub-image">
    <div class="card-header" style="background-color:#3765AF;">
        <?php if($image->user && $image->user->image): ?>

            <div class="container-avatar">
                <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" class="image-home" />
            </div>
        <?php endif; ?>
        <div class="data-user">
            <a href="{{route('profile', ['id'=>$image->user->id])}}" class="home-name">
                <?php if($image && $image->user): ?>
                    {{$image->user->name.' '.$image->user->surname.' | @'.$image->user->nick}}
                <?php endif; ?>
            </a>
        </div>
    </div>

                <div class="card-body">
                    
                    <div class="image-container">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" />
                    </div>
                    <div class="likes">
                        <!-- checks the like of the user-->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach

                        @if($user_like)
                            <img src="{{asset('img/heart-comrads-orange.png')}}" data-id="{{$image->id}}" class="btn-like"/>
                            @else
                            <img src="{{asset('img/heart-comrads-black.png')}}" data-id="{{$image->id}}" class="btn-dislike"/>
                        @endif
                        {{count($image->likes)}}
                    </div>
                    <div class="comments">
                        <a href="{{route('image.detail', ['id' => $image->id])}}"><img src="{{asset('img/comments-comrads.png')}}" /></a>
                        {{count($image->comments)}}
                    </div>
                    <div class="date">
                        <span>{{$image->created_at}}</span>
                    </div>
                    <div class="description">
                        
                        <br>
                        <span class="nickname">{{'@'.$image->user->nick}}</span>
                        <p>{{$image->description}}</p>
                        
                    </div>
                    
                </div>
            </div>
            <br>
