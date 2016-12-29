@extends('templates.main')

@section('content')
	<div class="row">
		<div class="user col-lg-5 col-md-5 col-sm-12 col-xs-12">
			@if(Auth::user()->hasFriendRequestFrom($user))
				<a href="{{ route('friend.accept', ['id' => $user->id]) }}" class="friend-accept friend-action btn btn-info ajax-link">Accept friend</a>
				<a href="{{ route('friend.deny', ['id' => $user->id]) }}" class="friend-deny friend-action btn btn-info ajax-link">Deny friend</a>
			@elseif($user->hasFriendRequestFrom(Auth::user()))
				<a href="#" class="friend-invite friend-action btn btn-info disabled">Invitation sent</a>				
			@elseif(!$user->isFriendWith(Auth::user()) && $user->id !== Auth::user()->id)
				<a href="{{ route('friend.request', ['id' => $user->id]) }}" class="friend-invite friend-action btn btn-info ajax-link">Invite to friends</a>
			@endif
			@include('user.avatar', ['size' => 128])
			<h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
			<div class="info">
				<p><span class="glyphicon glyphicon-calendar"></span> Birth date: {{ $user->birth_date }}</p>
			</div>
			<p>Friends: {{ $user->getFriendsCount() }}</p>
			<div class="friends">
				@foreach($user->getFriends() as $usr)
				<a class="friend" href="{{ route('user.show', ['id' => $usr->id]) }}">
					@include('user.avatar', ['user' => $usr, 'size' => 128])
					<span>{{ $usr->first_name }} {{ $usr->last_name }}</span>
				</a>
				@endforeach
			</div>
		</div>
		<div class="posts col-lg-7 col-md-7 col-sm-12 col-xs-12" data-source="{{ route('user.posts', ['id' => $user->id]) }}">
			@include('templates.post-form')
			<div class="loader" id="post-loader" style="display: none;">
				<span></span>
				<span></span>
				<span></span>
        	</div>
		</div>
		@include('templates.modals')
	</div>
@endsection