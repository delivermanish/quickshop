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
                    <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>



                </ul>
            </div>

            <div class="col-md-2"></div>
            
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center">
                          <span class="text-danger">
                              Hello !
                          </span>
                          
                        Change Your Password
                    </h3>

                    <div class="card-body">
                        <form method="post" action="{{route('user.password.update')}}">
                            @csrf
                            
                            <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Current Password<span></span></label>
                            <input type="password" name="oldpassword" id="current_password" class="form-control unicase-form-control text-input">
			                </div>

                            <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">New Password<span></span></label>
                            <input type="password" name="password" id="password" class="form-control unicase-form-control text-input">
			                </div>

                            <div class="form-group">
                            <label class="info-title" for="exampleInputEmail2">Confirm Password <span></span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control unicase-form-control text-input">
			                </div>

                            <div class="form-group">
                            <button type="submit" class="btn btn-danger">Update</button>
                            </div>

                        </form>

                    </div>



                </div>
            </div>

        </div>
    </div>

</div>

@endsection