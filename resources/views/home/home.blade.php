<x-layout>
    <div class="main-banner">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="caption header-text">
                <h6>Welcome to lugx</h6>
                <h2>BEST GAMING SITE EVER!</h2>
                <p>LUGX Gaming is free Bootstrap 5 HTML CSS website template for your gaming websites. You can download and use this layout for commercial purposes. Please tell your friends about TemplateMo.</p>
                <div class="search-input">
                  <form id="search" action="{{ route('home.search') }}" method="GET" onsubmit="return false;">
                      <input type="text" placeholder="Type Something" id="searchText" name="search" oninput="fetchSuggestions()" />
                      <button type="submit" role="button" onclick="performSearch()">Search Now</button>
                  </form>
                  <div id="suggestions" class="suggestions-box"></div>
              </div>
              </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
              <div class="right-image">
                <img src="{{asset('images/banner-image.jpg')}}" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="features">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <a>
                <div class="item">
                  <div class="image">
                    <img src="{{asset('images/featured-01.png')}}" alt="" style="max-width: 44px;">
                  </div>
                  <h4>Free Storage</h4>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6">
              <a>
                <div class="item">
                  <div class="image">
                    <img src="{{asset('images/featured-02.png')}}" alt="" style="max-width: 44px;">
                  </div>
                  <h4>User More</h4>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6">
              <a>
                <div class="item">
                  <div class="image">
                    <img src="{{asset('images/featured-03.png')}}" alt="" style="max-width: 44px;">
                  </div>
                  <h4>Reply Ready</h4>
                </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6">
              <a>
                <div class="item">
                  <div class="image">
                    <img src="{{asset('images/featured-04.png')}}" alt="" style="max-width: 44px;">
                  </div>
                  <h4>Easy Layout</h4>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    
      <div class="section most-played">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="section-heading">
                <h6>TOP GAMES</h6>
                <h2>Most Played</h2>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="main-button">
                <a href="{{route('shop')}}">View All</a>
              </div>
            </div>
            @foreach ($games as $game)
            <div class="col-lg-2 col-md-6 col-sm-6">
              <div class="item">
                <div class="thumb">
                  <a href="{{route('game.show',$game)}}"><img src="{{asset('storage/'.$game->image)}}" alt=""></a>
                </div>
                <div class="down-content">
                    <span class="category">@foreach ($game->categories as $category)
                        {{$category ->name}}
                    @endforeach</span>
                    <h4>{{$game -> name}}</h4>
                    <a href="{{route('game.show',$game)}}">Explore</a>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    
      <div class="section categories">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <div class="section-heading">
                <h6>Categories</h6>
                <h2>Top Categories</h2>
              </div>
            </div>
            @foreach ($categories as $category)
            <div class="col-lg col-sm-6 col-xs-12">
              <div class="item">
                <h4>{{$category->name}}</h4>
                <div class="thumb">
                  <a><img src="{{asset('storage/'.$category->image)}}" alt=""></a>
                </div>
              </div>
            </div>
            @endforeach
           
          </div>
        </div>
      </div>


    <div class="section cta">
        <div class="container">
        <div class="row">
            <div class="col-lg-5">
            <div class="shop">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="section-heading">
                      <h6>Our Shop</h6>
                      <h2>Go Pre-Order Buy & Get Best <em>Prices</em> For You!</h2>
                    </div>
                    <p>Lorem ipsum dolor consectetur adipiscing, sed do eiusmod tempor incididunt.</p>
                    <div class="main-button">
                      <a href="{{route('shop')}}">Shop Now</a>
                    </div>
                  </div>
                </div>
            </div>
            </div>
            <div class="col-lg-5 offset-lg-2 align-self-end">
            </div>
        </div>
      </div>
</x-layout>
<script>
  async function fetchSuggestions() {
      const query = document.getElementById('searchText').value;
      const response = await fetch(`/search/suggestions?query=${encodeURIComponent(query)}`);
      const suggestions = await response.json();
      displaySuggestions(suggestions);
  }

  function displaySuggestions(suggestions) {
      const suggestionsBox = document.getElementById('suggestions');
      suggestionsBox.innerHTML = '';

      if (suggestions.length === 0) {
          suggestionsBox.style.display = 'none';
          return;
      }

      suggestions.forEach(suggestion => {
          const div = document.createElement('div');
          div.textContent = suggestion.name;
          div.onclick = () => selectSuggestion(suggestion);
          suggestionsBox.appendChild(div);
      });

      suggestionsBox.style.display = 'block';
  }

  function selectSuggestion(suggestion) {
      // Redirect to the game show page
      window.location.href = `/game/${suggestion.id}`; 
  }

  function performSearch() {
      const searchText = document.getElementById('searchText').value;
      if (searchText) {
          window.location.href = `{{ route('home.search') }}?search=${encodeURIComponent(searchText)}`;
      }
  }
</script>