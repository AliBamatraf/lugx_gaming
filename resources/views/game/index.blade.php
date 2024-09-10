<x-layout>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <h3>Our Games</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <a href="{{route('game.create')}}" class="btn btn-primary">Create</a>

            @session('success')

            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>The game is deleted</p>
            </div>
            @endsession

            <table class="table caption-top">
                <caption>List of games</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">price</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Image</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                    <tr>
                        <td>{{$game -> id}}</td>
                        <td>{{$game -> name}}</td>
                        <td>{{Str::words($game -> description,10)}}</td>
                        <td>{{$game -> price}}</td>
                        <td>@foreach ($game ->categories as $category)
                            {{$category -> name}}
                        @endforeach</td>
                        <td><img
                            src="{{asset('/storage/'.$game -> image)}}"
                            class="rounded mx-auto d-block"
                            style="width: 300px; height: 300px;"
                            alt=""
                            />
                        </td>
                        <td>
                            <span class="d-grid gap-2 d-md-flex justify-content-md">
                                <a href="{{route('game.show',$game)}}" class="btn btn-info">show</a>
                                <a href="{{route('game.edit',$game)}}" class="btn btn-primary">Edit</a>
                                <form action="{{route('game.destroy',$game)}}" method="post">
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
                {{$games -> links('pagination::bootstrap-5')}}
        </div>
    </div>
</x-layout>