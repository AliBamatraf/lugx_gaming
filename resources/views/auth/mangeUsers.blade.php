<x-layout>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <h3>Mange Users</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            @if (session('success'))

            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>The user is deleted</p>
            </div>
            @endif

            @if(session('fail'))

            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Error!</h4>
                <p>{{$message}}</p>
            </div>
            @endif

            <table class="table caption-top">
                <caption>List of users</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user -> id}}</td>
                        <td>{{$user -> name}}</td>
                        <td>{{$user -> email}}</td>
                        <td>
                            <span class="d-grid gap-2 d-md-flex justify-content-md">
                                <form action="{{route('auth.deleteUser',$user)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                {{$users -> links('pagination::bootstrap-5')}}
        </div>
    </div>
</x-layout>