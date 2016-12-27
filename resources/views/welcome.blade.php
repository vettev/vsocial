@extends('templates.main')

@section('title')
Homepage
@endsection

@section('content')
	<div class="row">
		<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="welcome-screen">
			<h1>VSocial</h1>
			<h2>Explore better side of social network</h2>
			<p>Find your friends</p>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum doloribus facere blanditiis laudantium, nisi at. Nesciunt consequuntur itaque quos perspiciatis, cum sint. Rem modi, eveniet omnis ducimus impedit ab praesentium!
			</p>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatem quia iure fugit repellat harum, similique aut sed numquam consequatur quasi suscipit tempora, commodi non? Et quo est, aspernatur. Culpa, deleniti.
			</p>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12" id="register-form">
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul class="errors">
		            @foreach ($errors->all() as $error)
		                <li class="error">{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<h3>Register new account</h3>
			<form action="{{ route('register') }}" method="post" class="register-form">
				<div class="form-group">
			        <label for="email">E-mail</label>
			        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required value="{{ old('email') }}" />
			    </div>
			    <div class="form-group">
			    	<label for="password">Password</label>
			        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required value="{{ old('password') }}" />
			    </div>
			    <div class="form-group">
			    	<label for="password-r">Repeat password</label>
			        <input type="password" id="password-r" name="password_confirmation" class="form-control" placeholder="Repeat password" required value="{{ old('password_confirmation') }}" />
			    </div>
			    <div class="form-group form-inline birthdate">
			    	<label>Date of birth</label> <br/>
			    	<input type="number" name="bd_day" min="01" max="31" class="form-control" placeholder="DD" required value="{{ old('bd_day') }}" />
			    	<input type="number" name="bd_month" min="01" max="12" class="form-control" placeholder="MM" required value="{{ old('bd_month') }}" />
			    	<input type="number" name="bd_year" min="1900" max="2017" class="form-control" placeholder="YYYY" required value="{{ old('bd_year') }}" />
			    </div>
			    <div class="form-group">
			    	<label for="name">First name</label>
			    	<input type="text" name="first_name" id="name" class="form-control" placeholder="First name" required value="{{ old('first_name') }}" />
			    </div>
			    <div class="form-group">
			    	<label for="last-name">Last name</label>
			    	<input type="text" name="last_name" id="last-name" class="form-control" placeholder="Last name" required value="{{ old('last_name') }}" />
			    </div>
			    <button type="submit" class="btn btn-primary center-block">Register</button>
			    {{ csrf_field() }}
			</form>
		</div>
	</div>
	<!--
        <div class="modal fade" tabindex="-1" role="dialog" id="login-modal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Log in</h4>
                  </div>
                  <div class="modal-body text-center">
			          <form action="{{ route('login') }}" method="post">
			              <div class="form-group">
			              	<label for="email">E-mail</label>
			                <input type="email" name="email" class="form-control" placeholder="Email" />
			              </div>
			              <div class="form-group">
			              	<label for="password">Password</label>
			                <input type="password" name="password" class="form-control" placeholder="Password" />
			              </div>
			              <button type="submit" class="btn btn-primary center-block">Login</button>
			              {{ csrf_field() }}
			          </form>
                  </div>
            </div>
        </div>
    -->
@endsection