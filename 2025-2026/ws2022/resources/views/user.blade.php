@extends("layout")

@section("content")
<header>
    <nav>
        <a href="/admins">Admins</a>
        <a href="/users">Users</a>
        <a href="/games">Games</a>
    </nav>
</header>
    <div class="container">
        <h1>User</h1>

        <h3>{{$user->username}}</h3>

        @if($user->blocked == null)
            <a href="/users/{{user->id}}/block?reason=admin" class="btn btn-primary">Admin block</a>
            <a href="/users/{{user->id}}/block?reason=cheat" class="btn btn-primary">Block for cheating</a>
            <a href="/users/{{user->id}}/block?reason=spam" class="btn btn-primary">Block for spaming</a>
        @else
            <a href="/users/{{user->id}}/unblock" class="btn btn-primary">Unblock</a>
        @endif
    </div>
@endsection()