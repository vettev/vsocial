<div class="comment" id="comment-{{ $comment->id }}">
	<div class="created-at">{{ $comment->created_at->diffForHumans() }}</div>
	<a href="{{ route('user.show', ['id' => $comment->user->id]) }}">
		@include('user.avatar', ['size' => 32, 'user' => $comment->user])
		<span>{{ $comment->user->first_name }} {{ $comment->user->last_name }}</span>
	</a>
	<div class="comment-content">
		{{ $comment->content }}
	</div>
</div>