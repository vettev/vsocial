<?php

namespace VSocial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use VSocial\User;
use Auth;

class UserController extends Controller
{
    private $pusher;
    
    public function __construct()
    {
        $this->pusher = App::make('pusher');
    }
    
    public function show($id)
    {
    	$user = User::find($id);
    	if(!$user)
    		return redirect()->route('home');

    	return view('user.show', ['user' => $user]);
    }
    public function account()
    {
    	$user = Auth::user();
    	if(!$user)
    		return redirect()->route('home');

    	return view('user.account', ['user' => $user]);
    }
    public function accountSave(Request $request)
    {
    	$this->validate($request, [
    		'first_name' => 'required|max:255',
    		'last_name' => 'required|max:255',
    		'avatar' => 'image|mimes:jpeg,png,gif,svg,jpg|max:2048'
    		]);

    	$user = Auth::user();
    	if($request->hasFile('avatar') && $request->avatar->isValid()) {
            $path = $request->avatar->store('public');
            $user->avatar = substr(strstr($path, '/'), 1);
    	}
        $day = $request->bd_day;
        $month = $request->bd_month;
        $year = $request->bd_year;
        $birth_date = \DateTime::createFromFormat('j-n-Y', $day.'-'.$month.'-'.$year);

    	$user->first_name = $request->first_name;
    	$user->last_name = $request->last_name;
        $user->birth_date = $birth_date;
    	$user->update();

    	return redirect()->route('user.account');
    }
    public function friendRequest($id)
    {
    	$user = Auth::user();
    	$recipient = User::find($id);
    	$user->befriend($recipient);
        
        $channel = "private-user-".$recipient->id;
        $this->pusher->trigger($channel, 'add-friend', ['requestsCount' => count($recipient->getFriendRequests())]);

    	return null;
    }
    public function acceptFriend($id)
    {    	
    	$user = Auth::user();
    	$recipient = User::find($id);
    	$user->acceptFriendRequest($recipient);
        
        $channel = "private-user-".$recipient->id;
        $message = $user->first_name.' '.$user->last_name.' has accepted your friend request';
        $this->pusher->trigger($channel, 'friend-accepted', ['avatar' => $user->avatar, 'message' => $message]);

    	return null;
    }
    public function denyFriend($id)
    {
    	$user = Auth::user();
    	$recipient = User::find($id);
    	$user->denyFriendRequest($recipient);	

    	return null;
    }
    public function friendRequests(Request $request)
    {
    	if(!$request->ajax())
    		return redirect()->route('home');
    	
    	$user = Auth::user();
    	$requests = $user->getFriendRequests();
    	if(!$requests)
    		return null;

    	$users = [];
    	foreach ($requests as $req) {
    		$users[] = User::find($req->sender_id);
    	}

    	return view('user.friend-requests', ['request_users' => $users]);
    }
}
