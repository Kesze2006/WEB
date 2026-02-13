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
        <h1>Users</h1>
        <table>
            <thead>
                <tr>
                    <th>
                        Username
                    </th>
                    <th>
                        Registration date
                    </th>
                    <th>
                        Last login date
                    </th>
                    <th>

                    </th>
                    </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            {{$user->username}}
                        </td>
                        <td>
                            {{$user->registered_at}}
                        </td>
                        <td>
                            {{$user->last_login_at ?? "No login yet!"}}
                        </td>
                        <td>
                            <a href="/users/{{$user->username}}">Manage</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection()