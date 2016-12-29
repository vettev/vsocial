<ul class="user-notifications">
	@foreach($notifications as $notif)
		<li {{ !$notif->read_at ? 'class="unread"' : '' }}>
            <div class="avatar" style="width: 20%;">
            	@if($notif->data['avatar'])
            		<img src="{{ asset('storage/' . $notif->data['avatar']) }}" alt="User avatar" width="48" height="48" />
            	@else
            		<img src="{{ asset('storage/default-avatar.png') }}" alt="User avatar" width="48" height="48" />
            	@endif
            </div>
            <div class="content" style="width: 75%;">{{ $notif->data['message'] }}</div>
		</li>
		@php
			$notif->markAsRead();	
		@endphp
	@endforeach
</ul>