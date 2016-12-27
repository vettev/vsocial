<ul class="search-results">
	@foreach($users as $user)
		<li>
			<a href="{{ route('user.show', ['id' => $user->id]) }}">
				@include('user.avatar', ['size' => 64])
				<span>{{ $user->first_name }} {{ $user->last_name }}</span>
			</a>
		</li>
	@endforeach
</ul>