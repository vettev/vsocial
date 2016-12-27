@extends('templates.main')

@section('content')
	<div class="user center-block">
	<h3>Account edit</h3>
		<form action="{{ route('user.account.save') }}" method="post" enctype="multipart/form-data">
			<div class="form-group">
			    <label for="name">First name</label>
			    <input type="text" name="first_name" id="name" class="form-control" placeholder="First name" required value="{{ $user->first_name }}" />
			</div>
			<div class="form-group">
			    <label for="last-name">Last name</label>
			    <input type="text" name="last_name" id="last-name" class="form-control" placeholder="Last name" required value="{{ $user->last_name }}" />
			</div>
			<div class="form-group">
				<label for="avatar">Avatar</label>
				<input type="file" name="avatar" id="avatar" class="form-control" />
			</div>
			<div class="form-group form-inline birthdate">
			@php
				$birthdate = explode('-', $user->birth_date);
			@endphp
			    <label>Date of birth</label> <br/>
			    <input type="number" name="bd_day" min="01" max="31" class="form-control" placeholder="DD" required value="{{ $birthdate[2] }}" />
			    <input type="number" name="bd_month" min="01" max="12" class="form-control" placeholder="MM" required value="{{ $birthdate[1] }}" />
			    <input type="number" name="bd_year" min="1900" max="2017" class="form-control" placeholder="YYYY" required value="{{ $birthdate[0] }}" />
			</div>
			<button type="submit" class="btn btn-primary center-block" name="submit">Save account</button>
			{{ csrf_field() }}
		</form>
	</div>
@endsection