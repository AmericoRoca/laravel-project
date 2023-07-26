@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header" style="background-color:#3765AF; color:white">
                Upload new Image
            </div>
            <div class="card-body" style="background-color:white;">
                <form action="{{route('image.save')}}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    <div class="form-group row">
                        <label for="image_path" class="col-md-3 col-form-label text-md-right" style="color:#3765AF">Image</label>
                        <div class="col-md-7">
                            <input type="file" id="image_path" name="image_path" class="form-control" required style="background-color:#3765AF;color:white"/>

                            @if($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$erros->first('image_path')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="description" class="col-md-3 col-form-label text-md-right" style="color:#3765AF">Description</label>
                        <div class="col-md-7">
                            <textarea id="description" name="description" class="form-control" required ></textarea>

                            @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$erros->first('description')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-3">
                            <input type="submit" class="btn btn-primary" valure="Send" style="background-color:#3765AF; border-color:#3765AF">
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</div>




@endsection
