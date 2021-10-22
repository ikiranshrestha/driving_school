<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row" style="margin-top: 45px;">
            <div class="col-md-4 offset-md-4">
            @include('admin.layouts.message')
                <h4>Login</h4> <hr/>
                <form action="{{ route('auth.processLogin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value= "{{ old('email') }}" id="email" placeholder="Enter your email address">
                        <span class = "text-danger">
                            @error('email'){{ $message }} @enderror
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                        <span class = "text-danger">
                            @error('password'){{ $message }} @enderror
                        </span>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="col-md-12 btn btn-sm btn-block btn-primary" value="Login" name = "login">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>