<x-layout>
<div class="page-heading header-text">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>{{$currentGame -> name}}</h3>
                <span class="breadcrumb"><a href="{{route('home')}}">Home</a>  >  <a href="{{route('shop')}}">Shop</a>  >  {{$currentGame -> name}}</span>
            </div>
        </div>
    </div>
</div>

<div class="single-product section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-image">
                    <img src="{{asset('/storage/' .$currentGame -> image)}}" alt="">
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <h4>{{$currentGame -> name}}</h4>
                <span class="price">${{$currentGame -> price}}</span>
                <p>{{Str::words($currentGame -> description,20)}}</p>
                <form id="qty" action="{{route('stripe',$currentGame)}}" method="POST">
                    @csrf
                    <input type="number" class="form-control" id="1" aria-describedby="quantity" placeholder="1" name="quantity" value="1" min="1">
                    <button type="submit" data-product-id="{{ $currentGame->id }}"><i class="fa fa-shopping-bag"></i> Buy the game</button>
                </form>
                <ul>
                    <li>
                        <span>Category:</span> @foreach ($currentGame ->categories as $category)
                        {{$category -> name}},
                        @endforeach
                    </li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="sep"></div>
            </div>
        </div>
    </div>
</div>

<div class="more-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-content">
                    <div class="row">
                        <div class="nav-wrapper ">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                                </li>
                            </ul>
                        </div>              
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <p>
                                    {{$currentGame ->description}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section categories related-games">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Related Games</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="main-button">
                    <a href="{{route('shop')}}">View All</a>
                </div>
            </div>
            @foreach ($games as $game)
            <div class="col-lg col-sm-6 col-xs-12">
                <div class="item">
                    <h4>@foreach ($game ->categories as $category)
                        {{$category->name}}
                    @endforeach</h4>
                    <div class="thumb">
                        <a href="{{route("game.show",$game)}}"><img src="{{asset('storage/'.$game ->image )}}" style="width: 240px ;height:225 px" alt=""></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

</x-layout>
