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
                    <div class="data-user">
                     {{$image->user->name.''.$image->user->surname.' | @'.$image->user->nick}}
                    </div>

                </div>

                <div class="card-body">
                    
                    <div class="image-container">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" />
                    </div>
                    <div class="likes">
                        <img src="{{asset('img/heart-comrads2.png')}}" />
                    </div>
                    <div class="description">
                        <span>{{$image->created_at}}</span>
                        <br>
                        <span class="nickname">{{'@'.$image->user->nick}}</span>
                        <p>{{$image->description}}</p>
                        
                    </div>
                    <div class="comments">
                        <h2>Comments ({{count($image->comments)}})</h2>
                        <hr>
                        <form action="">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}">
                            <p>
                               <textarea class="form-control" name="content" required></textarea> 
                            </p>
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                    </div>
                    
                </div>
            </div>
            <br>
    
        </div>
    </div>
</div>
@endsection
