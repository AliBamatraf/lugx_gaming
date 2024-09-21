<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Login and Signup Form </title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css') }}">
                
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                        
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Login</header>
                    @error('error')
                            <span class="" style="color: red">
                                {{$message}}
                            </span>
                    @enderror
                    <form action="{{route('login')}}"  method="POST">
                        @csrf
                        <div class="field input-field">
                            <input type="email" placeholder="Email" name="email" class="input">
                            @error('email')
                                <span class="" style="color: red">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Password" name="password" class="password">
                            @error('password')
                                <span class="" style="color: red">
                                    {{$message}}
                                </span>
                            @enderror
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <a href="{{route('password.request')}}" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                            <button>Login</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="{{route('login.facebook')}}" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="{{route('login.google')}}" class="field google">
                        <img src="{{asset('images/google.png')}}" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>

            <!-- Signup Form -->

            <div class="form signup">
                <div class="form-content">
                    <header>Signup</header>
                    <form action="{{route('register')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="field input-field">
                            <input type="text" placeholder="User Name" name="name" class="input">
                            @error('name')
                                <span class="" style="color: red">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="email" placeholder="Email" name="email" class="input">
                            @error('email')
                                <span class="" style="color: red">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Create password" name="password" class="password">
                            @error('password')
                                <span class="" style="color: red">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input type="password" placeholder="Confirm password" name="password_confirmation" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="field button-field">
                            <button type="submit">Signup</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="{{route('login.facebook')}}" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="{{route('login.google')}}" class="field google">
                        <img src="{{asset('images/google.png')}}" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>
        </section>

        <!-- JavaScript -->
        <script src="js/script.js"></script>
    </body>
</html>