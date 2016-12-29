		<div class="post" id="post-{{ $post->id }}" data-id="{{ $post->id }}">
			@if($post->user->id === Auth::user()->id)
				<button class="operations-button"><span class="glyphicon glyphicon-chevron-down"></span></button>
				<ul class="operations">
					<li><a href="{{ route('post.edit', ['id' => $post->id]) }}" class="ajax-link edit post-edit"><span class="glyphicon glyphicon-edit"></span> Edit</a></li>
					<li><a href="{{ route('post.delete', ['id' => $post->id]) }}" class="ajax-link delete post-delete"><span class="glyphicon glyphicon-trash"></span> Delete</a></li>
				</ul>
			@endif
			<div class="created-at">
			<span>{{ $post->created_at->diffForHumans() }}</span>
				@if($post->created_at != $post->updated_at)
					<p class="edited">edited</p>
				@endif
			</div>
			<div class="created-by">
				@include('user.avatar', ['user' => $post->user, 'size' => 64])
				<a href="{{ route('user.show', ['id' => $post->user->id]) }}" title="User profile">
					<span>{{ $post->user->first_name }} {{ $post->user->last_name }}</span>
				</a>
			</div>
			@if($post->image)
				<img src="{{ asset('storage/'.$post->image) }}" alt="Post image" class="post-image img-responsive" />
			@endif
			<div class="content">{{ $post->content }}</div>
			<div class="actions">
				<a class="reactions-link post-action" href="{{ route('post.reactions', ['id' => $post->id]) }}"><span class="glyphicon glyphicon-thumbs-up"></span><span class="glyphicon glyphicon-thumbs-down"></span> Reactions: <span class="count">{{ count($post->likes) }}</span></a>
				@php
					$like = Auth::user()->likes->where('post_id', $post->id)->first();
				@endphp
				<a href="{{ route('post.like') }}" class="ajax-link post-like post-action {{ $like ? $like->like ? 'liked' : '' : '' }}"><span class="glyphicon glyphicon-thumbs-up"></span> <span class="text">{{ $like ? $like->like ? 'You liked this' : 'Like' : 'Like' }}</span></a>
				<a href="{{ route('post.like') }}" class="ajax-link post-dislike post-action {{ $like ? $like->like == 0 ? 'liked' : '' : '' }}"><span class="glyphicon glyphicon-thumbs-down"></span> <span class="text">{{ $like ? $like->like == 0 ? 'You disliked this' : 'Dislike' : 'Dislike' }}</span></a>
				<a href="#" class="post-action post-comments"><span class="glyphicon glyphicon-comment"></span> Comments: <span class="count">{{ count($post->comments) }}</span></a>
			</div>
			<div class="comments-section" style="display: none;">
				<div class="comments">
					@foreach($post->comments as $comment)
						@include('templates.comment')
					@endforeach
				</div>
				<form action="{{ route('comment.new', ['id' => $post->id]) }}" class="comment-form ajax-form">
					<input type="text" name="comment" placeholder="Comment content" class="form-control" autocomplete="off" />
				</form>
			</div>
		</div>