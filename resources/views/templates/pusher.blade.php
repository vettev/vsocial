<script src="//js.pusher.com/3.0/pusher.min.js"></script>
<script>
    var pusher = new Pusher("{{ env('PUSHER_KEY') }}", {
        cluster: 'eu',
        encrypted: true,
        auth: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    });
    var channelName = "private-user-{{ Auth::user()->id }}";
    var channel = pusher.subscribe(channelName);
    channel.bind('add-friend', function(data) {
        $('#friend-requests-notify .count').html(data.requestsCount).show();
    });
    channel.bind('notification', function(data) {
        $('#user-notifications-link .count').html(data.count).show();
        var toast = $('#toast-notification');
        toast.show();
        toast.find('.content').html(data.message);
        if(data.avatar)
        {
            var avatar = '{{  asset('storage') }}/' + data.avatar;
            toast.find('.avatar img').attr('src', avatar);
        }
        else
        {
            var avatar = '{{  asset('storage') }}/default-avatar.png';
            toast.find('.avatar img').attr('src', avatar);   
        }
        setTimeout(function() {
            toast.fadeOut();
        }, 10000);
    });
</script>