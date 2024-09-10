<x-layout>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Our Shop</h3>
                    <span class="breadcrumb"><a href="{{route('home')}}">Home</a> > Our Shop</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="section trending">
            <ul class="trending-filter">
                <li>
                    <a class="is_active" href="#!" data-filter="*">Show All</a>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <a href="#!" data-filter=".{{ strtolower(str_replace(' ', '-', $category->name)) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            
            <div class="row trending-box">
                @foreach ($games as $game)
                    <div class="col-lg-3 col-md-6 align-self-center mb-30 trending-items col-md-6 {{ implode(' ', $game->categories->map(fn($c) => strtolower(str_replace(' ', '-', $c->name)))->toArray()) }}">
                        <div class="item">
                            <div class="thumb">
                                <a href="{{ route('game.show', $game) }}"><img src="{{ asset('storage/' . $game->image) }}" alt=""></a>
                                <span class="price">${{ $game->price }}</span>
                            </div>
                            <div class="down-content">
                                <span class="category">
                                    @foreach ($game->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </span>
                                <h4>{{ $game->name }}</h4>
                                <a href="{{ route('game.show', $game) }}"><i class="fa fa-shopping-bag"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                {{$games->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</x-layout>
