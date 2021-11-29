@extends('frontend.main_master')
@section('content')
<div class="body-content">
    <div class="container"> 
        <div class="row">
            <div class="col-md-2">
                <img class="card-img-top" style="border-radius:50%;" 
                src="{{(!empty($userData->profile_photo_path))?url('upload/user_images/'.$userData->profile_photo_path): url('upload/user_images/default.jpg')}}"
                 height="100%" width="100%">

                <ul class="list-group list-group-flush">
                    <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>



                </ul>
            </div>

            <div class="col-md-2"></div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="text-center">
                          <span class="text-danger">
                              Hello !
                          </span>
                          <strong>{{Auth::user()->name}}</strong>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@endsection