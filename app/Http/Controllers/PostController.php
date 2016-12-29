<?php

namespace VSocial\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use VSocial\Post;
use VSocial\Like;
use VSocial\Comment;

class PostController extends Controller
{
    public function new(Request $request)
    {
    	$this->validate($request, [
    		'content' => 'required',
            'image' => 'image|mimes:jpeg,png,gif,svg,jpg|max:2048',
            ]);
    	$post = new Post();
    	$post->content = $request['content'];
    	$post->user_id = Auth::user()->id;
        if($request->hasFile('image') && $request->image->isValid() ) {
            $path = $request->image->store('public');
            $post->image = substr(strstr($path, '/'), 1);
        }
    	$post->save();

    	return redirect()->back();
    }

    public function delete($id, Request $request)
    {
        if(!$request->ajax())
            return redirect()->route('home');

        $post = Post::find($id);

        if(!$post)
            return null;

        if($post->user->id !== Auth::user()->id)
            return null;

        $post->delete();

        return null;
    }

    public function edit($id, Request $request)
    {
        $post = Post::find($id);
        if(!$post)
            return null;

        if($post->user->id !== Auth::user()->id)
            return null;

        $this->validate($request, [
            'content' => 'required'
            ]);
        $post->content = $request->content;
        $post->update();

        return view('templates.post', ['post' => $post]);
    }
    
    public function showPosts($page = 1, Request $request)
    {
        if(!$request->ajax())
            return null;
        
        $limit = env('PAGINATION_LIMIT');
        $user = Auth::user();
        $ids = [];
        foreach ($user->getFriends() as $friend) {
            $ids[] = $friend->id;
        }
        $ids[] = $user->id;
    	$posts = Post::whereIn('user_id', $ids)
            ->orderBy('created_at', 'desc')->take($limit)->skip(($page - 1) * $limit)->get();
        
        if(!$posts)
            return null;
        
        return view('templates.posts', ['posts' => $posts]);
    }

    public function like(Request $request)
    {
        $postId = $request['postId'];
        $isLike = $request['isLike'] === 'true';
        $update = false;
        $post = Post::find($postId);
        if(!$post)
            return null;
        
        $user = Auth::user();
        $like = $user->likes()->where('post_id', $postId)->first();
        if($like) {
            $alreadyLiked = $like->like;
            $update = true;
            if($alreadyLiked == $isLike) {
                $like->delete();
                return response()->json(['count' => count($post->likes)]);
            }
        } else {
            $like = new Like();
        }
        $like->like = $isLike;
        $like->user_id = $user->id;
        $like->post_id = $post->id;
        if($update)
            $like->update();
        else
            $like->save();
        
        return response()->json(['count' => count($post->likes)]);
    }

    public function reactions($id, Request $request)
    {
        if(!$request->ajax())
            return redirect()->route('home');

        $likes = Like::where('post_id', $id)->get();

        if(!count($likes))
            return null;

        return view('reactions', ['likes' => $likes]);
    }
}
