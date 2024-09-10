<x-layout>
    <div class="page-heading header-text">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h3>Our Categories</h3>
            </div>
          </div>
        </div>
      </div>

    <div class="section trending">
        <div class="container">
            <a href="{{route('category.create')}}" class="btn btn-primary">Create</a>

            @session('success')

            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>The category is deleted</p>
            </div>
            @endsession

            <table class="table caption-top">
                <caption>List of categories</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category -> id}}</td>
                        <td>{{$category -> name}}</td>
                        <td><img
                            src="{{asset('/storage/'.$category -> image)}}"
                            class="rounded mx-auto d-block"
                            style="width: 300px; height: 300px;"
                            alt=""
                            />
                        </td>
                        <td>
                            <span class="d-grid gap-2 d-md-flex justify-content-md">
                                <a href="{{route('category.edit',$category)}}" class="btn btn-primary">Edit</a>
                                <form action="{{route('category.destroy',$category)}}" method="post">
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
            {{$categories -> links('pagination::bootstrap-5')}}

        </div>
    </div>
</x-layout>