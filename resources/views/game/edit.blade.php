<x-layout>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Edit Game</h3>
                    <span class="breadcrumb">{{$game -> name}}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <a href="{{route('game.index')}}" class="btn btn-primary">Games</a>
            
            @session('success')
                
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Well done!</h4>
                <p>The game is updated</p>
            </div>
            @endsession
            
            <form action="{{route('game.update',$game)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Game name</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$game -> name}}" placeholder="Game Name" name="name">
                </div>
                @error('name')
                <div class="alert alert-warning" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Game price</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" value="{{$game -> price}}" placeholder="Game price" name="price">
                </div>
                @error('price')
                <div class="alert alert-warning" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="list-group">
                    
                    @php
                        // Extracting the IDs of the categories associated with the game
                        $selectedCategoryIds = $game->categories->pluck('id')->toArray();
                    @endphp

                    @foreach ($categories as $category)
                        <label class="list-group-item">
                            <input class="form-check-input me-1" type="checkbox" 
                                value="{{ $category->id }}" 
                                name="category_id[]" 
                                {{ in_array($category->id, $selectedCategoryIds) ? 'checked' : '' }}>
                                {{ $category->name }}
                        </label>
                    @endforeach

                

                    @error('category_id')
                        <div class="alert alert-warning" role="alert">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Game description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$game -> description}}</textarea>
                        
                    
                </div>
                @error('description')
                <div class="alert alert-warning" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="mb-3">
                    <img
                            src="{{asset('/storage/'.$game -> image)}}"
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