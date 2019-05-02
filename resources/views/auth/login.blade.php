@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
                <form class="form-horizontal was-validated" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body">
                        <h1>Login</h1>
                        <p class="text-muted">Sign In to your account</p>
                             
                            <div class="input-group mb-3{{ $errors->has('username') ? ' is-invalid' : '' }}">
                                <div class="input-group-addon">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                <input class="form-control" id="username" type="text"  name="username" value="{{ old('username') }}" required autofocus placeholder="Usuario">
                                    
                            </div>
                                        @if ($errors->has('username'))
                                            <span class="error-control invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                        
                                 <!-- {!! $errors->first('username','<span class="invalid-feedback">:message</span>')!!}</div> -->
                    
                        <div class="input-group mb-4">
                            <div class="input-group-addon">
                                <span class="input-group-text"><i class="icon-lock"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="current-password" placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    
                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary px-4" type="submit">Entrar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card text-white bg-dark py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <a class="btn btn-primary px-4 mt-5" href="{{ route('register') }}">Registro</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection
