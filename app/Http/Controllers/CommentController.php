<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{


    /**
     * @param  CommentRequest $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function create(CommentRequest $request, $id)
    {
        $comment = new Comment();
        $comment->id_user = Auth::user()->getAuthIdentifier();
        $comment->id_post = $id;
        $comment->text_comment = $request->input('textComment');

        $comment->save();
        return redirect()->route('getPost', $id)->with('success', 'Коментарий был добавлен');
    }//end create()
}//end class
