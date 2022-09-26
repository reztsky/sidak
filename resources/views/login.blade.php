<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{config('app.name')}}</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3 pt-3">
            <h2 class="text-center text-dark">Login</h2>
            <div class="card my-3">
                <form class="card-body cardbody-color p-3" method="POST" action="{{route('auth')}}">
                    @csrf
                    <div class="text-center">
                        <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                    </div>
                    @if (session('message'))
                        <div class="alert alert-danger my-3" role="alert">
                            {{session('message')}}
                        </div>
                    @endif                    
                    <div class="mb-3">
                        <input type="text" class="form-control" name="user" id="Username" aria-describedby="emailHelp" placeholder="User Name">
                        @error('username')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="password">
                        @error('password')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button></div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">
                        Not Registered? 
                        <a href="#" class="text-dark fw-bold"> Create anAccount</a>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
</body>
</html>