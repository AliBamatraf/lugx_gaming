<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Reset Password</title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css') }}">
                
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                        
    </head>
    <body>
        <section class="container forms">
            <!-- Signup Form -->
            <div class="form">
                <div class="form-content">
                    <header>Reset Password</header>
                    <form action="{{route('password.update')}}" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="token" value="{{$token}}">

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
                            <button type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>

    </body>
</html>