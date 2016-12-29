@extends('templates.main')

@section('title')
Homepage
@endsection

@section('content')
	<div class="posts center-block" data-source="{{ route('posts.load') }}">
		@include('templates.post-form')
		<div class="loader" id="post-loader" style="display: none;">
			  <span></span>
			  <span></span>
			  <span></span>
        </div>
	</div>
		@include('templates.modals')
@endsection