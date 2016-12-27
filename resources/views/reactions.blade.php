<ul class="reactions">
	@foreach($likes as $like)
		<li>
			<a href="{{ route('user.show', ['id' => $like->user->id]) }}" style="color: {{ $like->like ? 'green' : 'red' }}">
				@include('user.avatar', ['user' => $like->user, 'size' => 48] )
				{{ $like->user->first_name }} {{ $like->user->last_name }}</a>
		</li>
	@endforeach
</ul>