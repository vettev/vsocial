<ul class="friend-requests">
	@foreach($request_users as $usr)
		<li>
			<a href="{{ route('user.show', ['id' => $usr->id]) }}">
				@include('user.avatar', ['user' => $usr, 'size' => 48])
				<span class="text">{{ $usr->first_name }} {{ $usr->last_name }}</span>
			</a>
			<div>
				<a href="{{ route('friend.accept', ['id' => $usr->id]) }}" class="friend-accept friend-action ajax-link">Accept friend</a>
				<a href="{{ route('friend.deny', ['id' => $usr->id]) }}" class="friend-deny friend-action ajax-link">Deny friend</a>
			</div>
		</li>
	@endforeach
</ul>