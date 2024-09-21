<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Lugx Gaming Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('css/fontawesome.css') }} ">
    <link rel="stylesheet" href="{{asset('css/templatemo-lugx-gaming.css') }}">
    <link rel="stylesheet" href="{{asset('css/owl.css') }}">
    <link rel="stylesheet" href="{{asset('css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  </head>

<body>
  @php
  $totalQuantity = 0;
  @endphp
  
  @if(session('cart'))
  @foreach(session('cart') as $item)
      @php
      $totalQuantity += $item['quantity'];
      @endphp
  @endforeach
  @endif
  <!-- ***** Preloader Start ***** -->
  {{-- <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div> --}}
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{route('home')}}" class="logo">
                        <img src="{{asset('images/logo.png')}}" alt="" style="width: 158px;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{route('home')}}" class="active">Home</a></li>
                        <li><a href="{{route('shop')}}">Our Shop</a></li>
                        <li><a href="{{route('contact')}}">Contact Us</a></li>
                        @auth
                        @can('Purchaes Game')
                        <li><a href="{{route('orders')}}">Orders</a></li>
                        @endcan
                        @can('Add Game')
                        <li><a href="{{route('user.mangeUsers')}}">Users</a></li>
                        @endcan
                        @can('Add Game')
                        <li><a href="{{route('game.index')}}">Games</a></li>
                        @endcan
                        @can('Add Game')
                        <li><a href="{{route('category.index')}}">Categories</a></li>
                        @endcan
                        <li>
                            <form action="{{route('logout')}}" method="POST">
                            @csrf
                            @method('POST')
                                <button type="submit" name="logout" class="btn" style="background-color: #ee626b; color: white">
                                    Logout
                                </button>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li><a href="{{route("login")}}">Sign In</a></li>
                        @endguest
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
    </header>
  <!-- ***** Header Area End ***** -->
    {{$slot}}

    

<footer>
    <div class="container">
        <div class="col-lg-12">
            <p>Copyright © 2048 LUGX Gaming Company. All rights reserved. &nbsp;&nbsp; <a rel="nofollow" href="https://templatemo.com" target="_blank">Design: TemplateMo</a></p>
        </div>
    </div>
</footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('jquery/jquery.min.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/isotope.min.js')}}"></script>
    <script src="{{asset('js/owl-carousel.js')}}"></script>
    <script src="{{asset('js/counter.js')}}"></script>
    <script src="{{asset('js/custom.js')}}"></script>

  </body>
</html>