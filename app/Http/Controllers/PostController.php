<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * @var Post
     */
    private $post;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * @return Application|Factory|View
     */
    public function getListPosts()
    {
        $countPosts = $this->post->getCountPosts();
        $posts = [];
        if ($countPosts != 0) {
            $posts = Post::withCount('comments')->orderBy('created_at', 'DESC')
                ->simplePaginate(5);
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
     * @param Post $post
     * @return Application|Factory|RedirectResponseAlias|View
     */
    public function getFormUpdate(Post $post)
    {
        return $post->user_id != Auth::user()->getAuthIdentifier()
           ? redirect()->route('getPost', $post->id)->with('failed', 'Отказано в доступе')
           :  view('post.postUpdate', ['data' => $post]);
    }//end getFormUpdate()


    /**
     * @param Post $post
     * @return Application|Factory|View
     */
    public function getPost(Post $post)
    {
        $countComments = $post->comments()->get()->count();
        $comments = $post->count() == 0
            ? []
            : $post->comments()->get();

        if (! empty($comments)) {
            foreach ($comments as $id => $comment) {
                $comments[$id]['userName'] = $comment->user->name;
            }
        }

        return view(
            'post.post',
            [
                'data'     => $post,
                'comments' => $comments,
                'countComments' => $countComments,
                'creatorName' => $post->user()->get()->first()->name
            ]
        );
    }//end get()


    /**
     * @param  PostRequest $request
     * @return RedirectResponseAlias
     */
    public function createPost(PostRequest $request)
    {
        Post::create([
           'user_id' => (Auth::user()->getAuthIdentifier()),
           'title' => $request->input('title'),
           'description' => $request->input('description'),
           'text_post' => $request->input('textPost')
        ]);

        return redirect()->route('getPostList')->with('success', 'Статья была добавлена');
    }//end create()


    /**
     * @param Post $post
     * @param PostRequest $request
     * @return RedirectResponseAlias
     */
    public function updatePost(Post $post, PostRequest $request)
    {
        // need rewrite with roles
        if ($post->user_id != Auth::user()->getAuthIdentifier()) {
            return redirect()->route('getPost', $post->id)->with('failed', 'Отказано в доступе');
        }

        $post->update(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'text_post' => $request->input('textPost')
            ]
        );

        return redirect()->route('getPost', $post->id)->with('success', 'Статья была изменена');
    }//end update()


    /**
     * @param Post $post
     * @return RedirectResponseAlias
     * @throws Exception
     */
    public function deletePost(Post $post)
    {
        if ($post->user_id != Auth::user()->getAuthIdentifier()) {
            return redirect()->route('getPostList', $post->id)->with('failed', 'Отказано в доступе');
        }

        $post->comments()->delete();
        $post->delete();

        return redirect()->route('getPostList')->with('success', 'Статья была удалена');
    }//end delete()
}//end class
