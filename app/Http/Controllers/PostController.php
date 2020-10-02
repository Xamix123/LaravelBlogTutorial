<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PostController extends Controller
{


    /**
     * @return Application|Factory|View
     */
    public function getList()
    {
        $countPosts = Post::getCountPosts();
        $posts      = [];
        if ($countPosts != 0) {
            $posts = DB::table('posts')->orderBy('created_at', 'desc')->simplePaginate(5);
        }

        return view('post.postList', ['data' => $posts]);
    }//end getList()


    /**
     * @return Application|Factory|View
     */
    public function getFormAdd()
    {
        return view('post.postAdd');
    }//end getFormAdd()


    /**
     * @param int $id
     * @return Application|Factory|RedirectResponseAlias|View
     */
    public function getFormUpdate($id)
    {
        $post = Post::find($id);
        return $post->id_author != Auth::user()->getAuthIdentifier()
           ? redirect()->route('getPost', $post->id)->with('failed', 'Отказано в доступе')
           :  view('post.postUpdate', ['data' => $post]);
    }//end getFormUpdate()


    /**
     * @param  $id
     * @return Application|Factory|View
     */
    public function get($id)
    {
        $countComments = Comment::getCountCommentsForPost($id);
        $comments = $countComments == 0
            ? []
            : Comment::getCommentList($id);

        return view(
            'post.post',
            [
                'data'     => Post::find($id),
                'comments' => $comments,
            ]
        );
    }//end get()


    /**
     * @param  PostRequest $request
     * @return RedirectResponseAlias
     */
    public function create(PostRequest $request)
    {
        $post = new Post();
        $post->id_author = (Auth::user()->getAuthIdentifier());
        $post->title = ($request->input('title'));
        $post->description = ($request->input('description'));
        $post->text_post = ($request->input('textPost'));

        $post->save();

        return redirect()->route('getPostList')->with('success', 'Статья была добавлена');
    }//end create()


    /**
     * @param  $id
     * @param  PostRequest $request
     * @return RedirectResponseAlias
     */
    public function update($id, PostRequest $request)
    {
        $result = null;
        $post = Post::find($id);

        // need rewrite with roles
        if ($post->id_author != Auth::user()->getAuthIdentifier()) {
            $result = redirect()->route('getPost', $post->id)->with('failed', 'Отказано в доступе');
        } else {
            $post->id_author   = Auth::user()->getAuthIdentifier();
            $post->title       = $request->input('title');
            $post->description = $request->input('description');
            $post->text_post   = $request->input('textPost');

            $post->save();

            $result = redirect()->route('getPost', $post->id)->with('success', 'Статья была изменена');
        }

        return $result;
    }//end update()


    /**
     * @param  $id
     * @return RedirectResponseAlias
     */
    public function delete($id)
    {
        $post = Post::find($id);
        $result = null;
        if ($post->id_author != Auth::user()->getAuthIdentifier()) {
            $result = redirect()->route('getPostList', $post->id)->with('failed', 'Отказано в доступе');
        } else {
            Comment::deleteCommentList($id);
            $post->delete();
            $result = redirect()->route('getPostList')->with('success', 'Статья была удалена');
        }

        return $result;
    }//end delete()
}//end class
