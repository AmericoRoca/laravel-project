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
                            <img src="{{ route('user.avatar',['filename' => $image->user->image]) }}" class="avatar" />
                        </div>
                    @endif

                    <div class="data-detail">
                        {{ $image->user->name . ' ' . $image->user->surname . ' | @' . $image->user->nick }}
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" />
                    </div>

                    <div class="likes">
                        <!-- Check if the user has liked the image -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                            @if($like->user->id == Auth::user()->id)
                                <?php $user_like = true; ?>
                            @endif
                        @endforeach
                        
                        <div style="margin-top:17px; padding:0px; margin-bottom:0px;">
                            @if($user_like)
                                <img src="{{ asset('img/heart-comrads-orange.png') }}" data-id="{{ $image->id }}" class="btn-like" />
                            @else
                                <img src="{{ asset('img/heart-comrads-black.png') }}" data-id="{{ $image->id }}" class="btn-dislike" />
                            @endif
                            {{ count($image->likes) }}
                            <span class="date-details">{{ $image->created_at }}</span>
                        </div>
                    </div>

                    <br><br>

                    <div class="description">
                        <span class="nickname">{{ '@' . $image->user->nick }}</span>
                        <p>{{ $image->description }}</p>
                    </div>

                    <div class="comments">
                        <h2>Comments ({{ count($image->comments) }})</h2>
                        <hr>

                        <!-- Formulario para agregar comentario -->
                        <form method="POST" action="{{ route('comment.save') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="image_id" value="{{ $image->id }}">
                            <p>
                                <textarea id="content" class="form-control" name="content" required></textarea> 
                                @if($errors->has('content'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </p>
                            
                            <button type="submit" class="btn btn-success" style="float:left; display:inline">Send</button>
                        </form>

                        @if(Auth::user() && Auth::user()->id == $image->user->id)
                            <div class="actions" style="width:250px">
                                <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger rojo" style="margin-left:10px">Delete</a>
                            </div>
                        @endif

                        <hr>

                        <!-- Lista de comentarios -->
                        @foreach($image->comments as $comment)
                            <div class="comment">
                                <p><strong>{{ '@' . $comment->user->nick }}</strong></p>
                                <span>{{ $comment->created_at }}</span>
                                <br>
                                <p>{{ $comment->content }}</p>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection
