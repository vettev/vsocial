<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <title>VSocial</title>
        @yield('css')
    </head>
    <body>
        @include('templates.header')
        <div class="container main-content">
    	   @yield('content')
        </div>
        <div id="toast-notification" style="display: none;">
            <div class="avatar" style="width: 20%;"><img src="{{ asset('storage/default-avatar.png') }}" alt="User avatar" width="48" height="48" /></div>
            <div class="content" style="width: 75%;">Janusz Testowy has accepted your friend request.</div>
            <button id="close-toast"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="//js.pusher.com/3.0/pusher.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        @if(Auth::user())
            @include('templates.pusher')
        @endif
        @yield('js')
    </body>
</html>
