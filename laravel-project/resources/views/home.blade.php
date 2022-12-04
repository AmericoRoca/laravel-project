@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        @include('includes.message')

        @foreach($images as $image)  
            <div class="card pub-image">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{route('user.avatar',['filename'=>$image->user->image])}}" class="image-home" />
                    </div>
                    @endif
                    <div class="data-user">
                        <a href="{{route('image.detail', ['id' => $image->id])}}" class="home-name">
                         {{$image->user->name.''.$image->user->surname.' | @'.$image->user->nick}}
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    
                    <div class="image-container">
                        <img src="{{route('image.file',['filename'=>$image->image_path])}}" />
                    </div>
                    <div class="likes">
                        <img src="{{asset('img/heart-comrads2.png')}}" />
                    </div>
                    <div class="comments">
                        <a href="{{route('image.detail', ['id' => $image->id])}}"><img src="{{asset('img/comments-comrads.png')}}" /></a>
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
             @endforeach
            <!--pagination-->
            <div class="clearfix">
                {{$images->links()}}
            </div>
    
        </div>
    </div>
</div>
@endsection
