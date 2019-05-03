@extends('layouts.app')

@section('content')
	<div class="row justify-content-center">
        <div class="col-md-6">
          	<form method="POST" action="{{ route('register') }}">
            @csrf
	          	<div class="card mx-4">
		            <div class="card-body p-4">
		              	<h1>Registro</h1>
		              	<p class="text-muted">Crea tú cuenta</p>
						<div class="input-group mb-3">
		                	<div class="input-group-addon">
		                  		<span class="input-group-text"><i class="icon-user-follow"></i></span>
		                	</div>
		                	<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  autocomplete="name"  placeholder="Nombre y Apellido" required autofocus>
		                	
		                	@if ($errors->has('name'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('name') }}</strong>
	                            </span>
	                     	@endif
		              	</div>	

		              	<div class="input-group mb-3">
		                	<div class="input-group-addon">
		                  		<span class="input-group-text"><i class="icon-user"></i></span>
		                	</div>
		                	<input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autocomplete="username" placeholder="Username">

		                	@if ($errors->has('username'))
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $errors->first('username') }}</strong>
	                            </span>
	                     	@endif
		              	</div>

		              	<div class="input-group mb-3">
		                	<div class="input-group-addon">
		                  		<span class="input-group-text"><i class="icon-envelope"></i></span>
		                	</div>
		                	<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
		              	</div>

		              	<div class="input-group mb-3">
		                	<div class="input-group-addon">
		                		<span class="input-group-text"><i class="icon-lock"></i></span>
		                	</div>
		                	<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="new-password" placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
		              	</div>

		              	<div class="input-group mb-4">
		                	<div class="input-group-addon">
		                  		<span class="input-group-text"><i class="icon-lock"></i></span>
		                	</div>
		                	<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar password">
		              	</div>
		            </div>
		            <div class="card-footer p-4">
		            	<div class="row">
		                	<div class="col-6">
		                		<a href="{{ route('login') }}" class="btn btn-block btn-info text-white">Login</a>
		                  		<!-- <button class="btn btn-block btn-info" type="button">
		                    		<span class="text-white">Login</span>
		                  		</button> -->
		                	</div>
		                	<div class="col-6">
		                  		<button class="btn btn-block btn-success" type="submit">
		                    		<span>Crear Cuenta</span>
		                  		</button>
		                	</div>
		              </div>
		            </div>
	          </div>
	       	</form>
        </div>
    </div>
@endsection