<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Reset Password </title>

        <!-- CSS -->
        <link rel="stylesheet" href="{{asset('css/style.css') }}">
                
        <!-- Boxicons CSS -->
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
                        
    </head>
    <body>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Reset Password</header>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Well done!</h4>
                        <p>Password rest link was sent to your email</p>
                    </div>
                    @endif
                    
                    <form action="{{route('password.email')}}"  method="POST">
                        @csrf
                        <div class="field input-field">
                            <input type="email" placeholder="Email" name="email" class="input">
                            @error('email')
                                <span class="" style="color: red">
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="field button-field">
                            <button>Reset password</button>
                        </div>
                    </form>
    </body>
</html>