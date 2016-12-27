@extends('templates.main')

@section('title')
Homepage
@endsection

@section('content')
	<div class="posts center-block">
		@include('templates.post-form')
		@foreach($posts as $post)
			@include('templates.post')
		@endforeach
		@include('templates.modals')
	</div>
@endsection