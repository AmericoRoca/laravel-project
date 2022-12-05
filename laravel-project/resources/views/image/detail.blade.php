@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
        @include('includes.message')

            <div class="card pub-image">
                <div class="card-header">
                    @if($image->user->image)
                        <div class="container-avatar">
                            <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" />
                        </div>
                    @endif
                        <div class="data-detail">
                            {{$image->user->name.''.$image->user->surname.' | @'.$image->user->nick}}
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
                    <br>
                    <div class="description">
                        <span class="date-details">{{$image->created_at}}</span>
                        <br>
                        <span class="nickname">{{'@'.$image->user->nick}}</span>
                        <p>{{$image->description}}</p>
                        
                    </div>
                
                    <div class="comments">
                        <h2>Comments ({{count($image->comments)}})</h2>
                        <hr>
                        <form action="POST" action="{{ route('comment.save')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <p>
                                <textarea id="content" class="form-control" name="content" required></textarea> 
                                    @if($errors->has('content'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$errors->first('content')}}</strong>
                                        </span>

                                    @endif
                            </p>
                            
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                        <hr>
                        @foreach($image->comments as $comment)
                            <div class="comment">
                                <p>{{$comment->user->nick}}</p>
                                <span>{{$comment->created_at}}</span>
                                <br>
                                <p>{{$comment->content}}</p>
                            
                            </div>

                        </div>
                        @endforeach
                    </div>
                    
                </div>
            </div>
            <br>
    
        </div>
    </div>
</div>
@endsection
