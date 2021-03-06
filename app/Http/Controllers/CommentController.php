<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * @param CommentRequest $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function createComment(CommentRequest $request, Post $post)
    {
        Comment::create([
            'user_id' => (Auth::user()->getAuthIdentifier()),
            'post_id' => $post->id,
            'text_comment' => $request->input('textComment')
        ]);

        return redirect()->route('getPost', $post->id)->with('success', 'Коментарий был добавлен');
    }//end create()
}//end class
