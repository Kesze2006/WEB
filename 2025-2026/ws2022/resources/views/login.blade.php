@extends("layout")

@section("content")
    <form action="/login" class="login-form" method="POST">
    @if($errors->any())
        <div class="alert alert-danger">
            {{$errors->first()}}
        </div>
    @endif
    @csrf
    <h1>Login</h1>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="form-control" autofocus>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
    </form>
@endsection