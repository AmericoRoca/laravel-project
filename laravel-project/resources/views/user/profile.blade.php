@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="data-user">
                
                    @if($user->image)
                        <div class="img-profile"  style="width:200px; display:inline; float:left; heigth:100px">
                            <img src="{{route('user.avatar', ['filename'=>$user->image])}}" alt="" style="width:150px; border-radius:50px; border-color:black;" />
                            
                        </div>
                    @endif
               
                <div class="user-info-profile">
                    <h1 style="color:#F58026">{{'@'.$user->nick}}</h1>
                    <h2 style="color:#F58026">{{$user->name.''.$user->surname}}</h2>
                    <p style="color:#F58026">{{$user->description}}</p>
                </div>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        @foreach($user->images as $image)
            @include('includes.image', ['image'=>$image])

        @endforeach
       
    
        </div>
    </div>
</div>
@endsection
