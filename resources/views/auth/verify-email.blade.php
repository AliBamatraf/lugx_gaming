<x-layout>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Verify Email </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>
    
                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
    
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit" class="btn btn-link  p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <h1 class="mb-4">
        please verify your email through the emails we've sent to you
    </h1>
    <form action="{{route('verification.send')}}" method="post">
        @csrf
        <p>Did not recieve email</p>
        <button class="btn btn-primary" type="submit">Send again</button>
    </form> --}}
</x-layout>