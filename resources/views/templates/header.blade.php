<header class="main-header">
<nav class="navbar navbar-inverse navbar-custom">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('home') }}">VSocial</a>
    </div>
    @if(Auth::user())
    <form class="navbar-form navbar-left search ajax-form" method="post" action="{{ route('search') }}" id="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search" name="condition" id="search-input">
      </div>
      {{ csrf_field() }}
    </form>
    @endif
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav navbar-right">
      @if(Auth::guest())
          <form action="{{ route('login') }}" method="post" class="navbar-form">
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Email" autofocus />
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" />
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            {{ csrf_field() }}
          </form>
      @else
        <li id="friend-requests-li" class="notifications-li">
          <a href="{{ route('friend.requests', ['id' => Auth::user()->id]) }}" id="friend-requests-notify" class="friend-notifications-link ajax-link">
            <span class="glyphicon glyphicon-user"></span>
            <span class="count" style="{{ count(Auth::user()->getFriendRequests()) == 0 ? 'display: none;' : '' }}">
                    {{ count(Auth::user()->getFriendRequests()) }}
              </span>
          </a>
          <div id="friend-notifications" style="display: none;" class="notifications-block">
          </div>
        </li>
        <li id="user-notifications-li" class="notifications-li">
          <a href="{{ route('user.notifications') }}" class="ajax-link user-notifications-link" id="user-notifications-link"><span class="glyphicon glyphicon-bell"></span>
          <span class="count" style="{{ count(Auth::user()->unreadNotifications) == 0 ? 'display: none;' : '' }}">{{ count(Auth::user()->unreadNotifications) }}</span>
          </a>
          <div id="user-notifications" style="display: none;" class="notifications-block">
          </div>
        </li>
        <li>
          <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">
          {{ Auth::user()->first_name }}
          </a>      
        </li>
        <li>
          <a href="{{ route('user.account') }}">Account</a>
        </li>
        <li>
          <a href="{{ route('logout') }}">Logout</a>
        </li>
      @endif
      </ul>
    </div>
  </div>
</nav>
</header>