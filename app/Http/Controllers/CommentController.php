<?php

namespace VSocial\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use VSocial\Post;
use VSocial\Comment;

class CommentController extends Controller
{
	public function commentNew($id, Request $request)
    {
    	if(!$request->ajax())
    		return redirect()->route('home');

        $post = Post::find($id);
        if(!$post)
            return null;

        $this->validate($request, ['comment' => 'required']);

        $comment = new Comment();
        $comment->content = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->save();

        return view('templates.comment', ['comment' => $comment]);
    }
}
