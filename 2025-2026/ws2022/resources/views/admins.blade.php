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
        <h1>Admins</h1>
        <table>
            <thead>
                <tr>
                    <th>
                        Username
                    </th>
                    <th>
                        Last login date
                    </th>
                    </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td>
                            {{$admin->username}}
                        </td>
                        <td>
                            {{$admin->last_login_at ?? "No login yet!"}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection()