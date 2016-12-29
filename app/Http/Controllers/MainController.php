<?php

namespace VSocial\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Auth;
use VSocial\Post;
use VSocial\User;

class MainController extends Controller
{
    public function index()
    {
    	if(Auth::user())
    		return view('home');
    	else
    		return view('welcome');
    }

    public function search(Request $request)
    {
        if(!$request->condition)
            return null;
        $condition = $request->condition;
        $users = User::where('last_name', 'like', '%'.$condition.'%')
            ->orWhere('first_name', 'like', '%'.$condition.'%')
            ->get();
        if(!count($users))
            return null;

        return view('search-results', ['users' => $users]);
    }
    
    public function pusherAuth(Request $request)
    {
        if(Auth::user())
        {
            $pusher = App::make('pusher');
            $channelName = $request->channel_name;
            $socketId = $request->socket_id;
            
            return $pusher->socket_auth($channelName, $socketId);
        }
    }
}
