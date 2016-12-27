		<div class="post-form">
			<h3>Post something</h3>
			<form action="{{ route('post.new') }}" method="post" enctype="multipart/form-data">
				<textarea name="content" id="post-content" class="form-control" rows="5" placeholder="Post content"></textarea>
				<input type="file" name="image" id="post-image" />
				<label for="post-image" class="btn btn-info"><span class="glyphicon glyphicon-picture"></span> <span class="text">Choose file</span></label>
				<button type="submit" class="btn btn-info submit inline">Post</button>
				{{ csrf_field() }}
			</form>
		</div>