var somethingOpen = false; //flag that checks if any closeable element is open
var page = 1;
var canLoad = true;

$(document).ready(function()
{
	loadPosts();
	
	$(window).scroll(function() {
		if(($(window).scrollTop() + $(window).height()) == $(document).height() && canLoad) {
			canLoad = false;
			loadPosts();
		}
	});
	
	//js support for input type file styling
	$('#post-image').change(function(e) {
		var label = $(this).next().find('.text');
		var labelContent = label.html();
		var fileName = e.target.value.split( '\\' ).pop();
		if(fileName)
			label.html(fileName);
		else
			label.html(labelContent);
	});

	$('.posts').on('click', '.operations-button', function(e) {
		e.stopPropagation();
		var operations = $(this).parent().find('.operations');
		operations.toggle().toggleClass('closeable-active');

		if(operations.hasClass('closeable-active'))
			somethingOpen = true;
	});

	$('#friend-requests-notify').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		$.ajax({
			url: href,
			success: function(data) {
				var notifs = $('#friend-notifications');
				notifs.html(data);
				notifs.toggle().toggleClass('closeable-active');

				if(notifs.hasClass('closeable-active'))
					somethingOpen = true;
			}
		});
	});
	
	$('.user, #friend-notifications').on('click', '.friend-action', function(e) {
		e.preventDefault();
		var clicked = $(this);
		var href = $(this).attr('href');
		var requestsCount = $('.friend-requests > li').length;
		var countElement = $('#friend-requests-notify .count');
		$.ajax({
			url: href,
			success: function() {
				if(clicked.hasClass('friend-invite'))
					clicked.html("Invitation sent");

				if(clicked.hasClass('friend-accept') || clicked.hasClass('friend-deny'))
				{
					clicked.parent().find('.friend-action').remove();
					requestsCount--;	
					
					if(requestsCount > 0)
						countElement.html(requestsCount);
					else
						countElement.hide();
				}
			}
		});
	});

	$(document).click(function() {
		if(somethingOpen)
		{
			$('.closeable-active').hide('400').removeClass('closeable-active');
			somethingOpen = false;
		}
	});

	$('.main-content').on('click', '.ajax-link', function(e) {
		e.preventDefault();

		var href = $(this).attr('href');

		if($(this).hasClass('delete'))
		{
			var target = $(this).parent().parent().parent();

			$.ajax({
				url: href,
				success: function() {
					target.slideUp();
				}
			});
		}
		if($(this).hasClass('friend-action'))
		{
			var clicked = $(this);
			$.ajax({
				url: href,
				success: function() {
					if(clicked.hasClass('friend-invite'))
						clicked.html("Invitation sent").addClass('disabled');

					if(clicked.hasClass('friend-accept') || clicked.hasClass('friend-deny'))
						clicked.parent().find('.friend-action').remove();
				}
			});
		}
		if($(this).hasClass('post-edit'))
		{
			var form = $('#post-edit-form');
			var modal = $('#edit-modal');
			var post = $(this).parent().parent().parent();
			var postContent = post.find('.content').html();
			form.attr('action', href);
			postContent = postContent.replace(/&gt;/g, '>');
			postContent = postContent.replace(/&lt;/g, '<');
			form.find('#post-edit-input').val(postContent);
			modal.modal();

			form.submit(function(e) {
				e.preventDefault();
				$.ajax({
					url: href,
					data: form.serialize(),
					success: function(data) {
						post.replaceWith(data);
						modal.modal('hide');
					}
				});
			});
		}
		if($(this).hasClass('post-action'))
		{
			var token = $(this).data('token');
			var postId = $(this).parent().parent().data('id');
			var isLike = $(this).hasClass('post-like');
			var clicked = $(this);

			$.ajax({
				method: 'POST',
				url: href,
				data: {
					postId: postId,
					_token: token,
					isLike: isLike,
				},
				success: function(msg) {
					if(isLike)
		            {
		                if(!clicked.hasClass('liked'))
		                {
		                    clicked.parent().find('.liked').removeClass('liked');
		                    clicked.addClass('liked').find('.text').html('You liked it');
		                }
		                else
		                {
		                    clicked.find('.text').html('Like');
		                    clicked.parent().find('.liked').removeClass('liked');
		                }
		                
		                clicked.next().find('.text').html('Dislike');
		            }
		            else
		            {
		                if(!clicked.hasClass('liked'))
		                {      
		                    clicked.parent().find('.liked').removeClass('liked');
		                    clicked.addClass('liked').find('.text').html('You disliked it');
		                }
		                else
		                {
		                    clicked.find('.text').html('Dislike');
		                    clicked.parent().find('.liked').removeClass('liked');
		                }
		                
		                clicked.prev().find('.text').html('Like');
		            }
		            clicked.parent().parent().find('a.reactions-link span.count').html(parseInt(msg.count));
				}
			});
		}
	});

	$('.posts').on('click', '.post-comments', function(e) {
		e.preventDefault();
		$(this).parent().parent().find('.comments-section').toggle();
	});

	$('.posts').on('click', '.reactions-link', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		var modal = $('#uni-modal');
		modal.modal();
		$.ajax({
			url: href,
			success: function(data) {
				modal.find('.modal-title').html('Reactions');
				if(data)
					modal.find('.modal-body').html(data);
				else
					modal.find('.modal-body').html('No reactions');
			}
		});
	});

	$('body').on('submit', '.ajax-form', function(e) {
		e.preventDefault();
		var url = $(this).attr('action');
		var form = $(this);

		if(form.hasClass('search'))
		{		
			$.ajax({
				url: url,
				method: 'POST',
				data: form.serialize(),
				success: function(data) {
					var modal = $('#uni-modal');
					modal.modal();
					modal.find('.modal-title').html('Search results');
					if(data)
						modal.find('.modal-body').html(data);
					else
						modal.find('.modal-body').html('Nothing found');
					form.find('#search-input').val('');
				}
			});
		}
		else if(form.hasClass('comment-form'))
		{
			$.ajax({
				url: url,
				data: form.serialize(),
				success: function(data) {
					form.find('input').val('');
					form.before(data);
					var commentsCount = form.parent().parent().find('.post-comments .count');
					commentsCount.html(parseInt(commentsCount.html()) + 1);
				}
			})
		}
	});
});

function loadPosts()
{
	var url = $('.posts').data('source') + '/' + page;
	var loader = $('#post-loader');
	
	$.ajax({
		url: url,
		beforeSend: function() {
			loader.show();
		},
		success: function(data) {
			if(data) {
				$('#post-loader').before(data);
				page++;
				canLoad = true;
			}
			loader.hide();
		}
	})
}