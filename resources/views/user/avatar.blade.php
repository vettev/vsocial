@if($user->avatar)
	<img src="{{ asset('storage/'.$user->avatar) }}" alt="User avatar" class="user-avatar" width="{{ $size }}" height="{{ $size }}" />
@else
	<img src="{{ asset('storage/default-avatar.png') }}" alt="User avatar" class="user-avatar" width="{{ $size }}" height="{{ $size }}" />
@endif