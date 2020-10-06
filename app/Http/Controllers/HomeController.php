<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $countPosts = $this->post->getCountPosts();
        $count = $this->post->comments()->get()->count();
        $posts = [];
        if ($countPosts != 0) {
            $posts = $this->post->getLastPosts(Post::DEFAULT_NUMBER_POSTS);
        }

        $posts = $this->post->addCountCommentsByTheListPosts($posts);

        return view('home', [
            'data' => $posts,
        ]);
    }//end index()

    /**
     * @return Application|Factory|View
     */
    public function about()
    {
        return view('about');
    }//end about()
}//end class
