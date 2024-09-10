<x-layout>
    <div class="page-heading header-text">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h3>Edit Category</h3>
              <span class="breadcrumb">{{$category -> name}}</span>
            </div>
          </div>
        </div>
      </div>

    <div class="section trending">
        <div class="container">
            @session('success')
                
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>The category is updated</p>
            </div>
            @endsession
            <form action="{{route('category.update',$category)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Category name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Category Name" value="{{$category ->name}}" name="name">
                </div>
                @error('name')
                <div class="alert alert-warning" role="alert">
                    {{$message}}
                </div>
                @enderror
                <div class="mb-3">
                    <img
                            src="{{asset('/storage/'.$category -> image)}}"
                            class="rounded mx-auto d-block"
                            style="width: 300px; height: 300px;"
                            alt=""
                            />
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Image</label>
                    <input class="form-control" type="file" id="formFile" name="image">
                </div>
                @error('image')
                <div class="alert alert-warning" role="alert">
                    {{$message}}
                </div>
                @enderror
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Edit</button>
                  </div>
            </form>
        </div>
    </div>
</x-layout>