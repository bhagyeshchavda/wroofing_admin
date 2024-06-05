@extends('layouts.auth')
@section('title') {{'Sign in'}} @endsection
@section('content')
@php 
$generalSetting = get_general_settings();
$siteLogo       = '';
if(!empty($generalSetting)){
    if(isset($generalSetting['gs_adminlogo'])){
        $siteLogo       = $generalSetting['gs_adminlogo'];
        $siteLogo       = $siteLogo ? $siteLogo : '';
    }
}
@endphp
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="{{ route('home') }}" class="h1" target="_blank">
                <img src="{{ asset($siteLogo) }}" alt="site-logo" width="250"/>
            </a>
        </div>
        <div class="card-body">
            {{-- <p class="login-box-msg">Sign in to start your session</p> --}}

            <form method="POST" action="{{ route('login') }}">
            @csrf
                <div class="input-group mb-3">
                    <input id="email" type="email" placeholder="Email/Username" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input id="password"  placeholder="Password" type="password" class="password-field form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text password-hide-show" style="cursor: pointer;">
                            <span style="width: 16px;" class="fas fa-eye-slash"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="{{ route('password.request') }}">I forgot my password</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
<script>
    jQuery(document).ready(function(){
        jQuery('.login-box').find('.password-hide-show').on('click', function(e){
            e.preventDefault();
            var passwordField = jQuery('.password-field');
            var passwordFieldType = passwordField.attr('type');

            if(passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                jQuery(this).find('span').removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                passwordField.attr('type', 'password');
                jQuery(this).find('span').removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    });
</script>    
@endsection
