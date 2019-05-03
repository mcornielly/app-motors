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
                        <p class="text-muted">Iniciar sesión en su cuenta</p>
                             
                            <div class="input-group row mb-3">
                                <div class="input-group-addon">
                                    <span class="input-group-text"><i class="icon-user"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" id="username" type="text"  name="username" value="{{ old('username') }}" required autofocus placeholder="Usuario">
                            
                                @if ($errors->has('username'))
                                    <span class="error-control invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                    
                            <div class="input-group row mb-4">
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
                    </div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <button class="btn btn-primary px-4" type="submit">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>
           <div class="card text-white bg-dark py-5 d-md-down-none" style="width:44%">
                 <div class="card-body text-center">
                    <div>
                      <h2>Motors App</h2>
                      <p class="mt-5">Sitema de control de atención de mantenimiento de vehículos.</p>
                      <a class="btn btn-primary px-4 mt-5" href="{{ route('register') }}">Registro</a>
                    </div>
                </div>
            </div>
        </div>
      </div>
</div>
@endsection
