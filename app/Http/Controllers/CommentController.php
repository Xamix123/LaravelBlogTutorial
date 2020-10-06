<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param  CommentRequest $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function create(CommentRequest $request, $id)
    {
        $this->comment = Comment::create([
            'user_id' => (Auth::user()->getAuthIdentifier()),
            'post_id' => $id,
            'text_comment' => $request->input('textComment')
        ]);

        return redirect()->route('getPost', $id)->with('success', 'Коментарий был добавлен');
    }//end create()
}//end class
