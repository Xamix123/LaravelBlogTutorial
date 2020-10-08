<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $countPosts = $this->post->getCountPosts();
        $posts = [];
        if ($countPosts != 0) {
            $posts = $this->post->getLastPosts(Post::DEFAULT_NUMBER_POSTS);
        }

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
