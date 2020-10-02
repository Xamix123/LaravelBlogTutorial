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
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $countPosts = Post::getCountPosts();
        $posts      = [];
        if ($countPosts != 0) {
            $posts = Post::getLastPosts(Post::DEFAULT_NUMBER_POSTS);
        }

        return view('home', ['data' => $posts]);
    }//end index()

    /**
     * @return Application|Factory|View
     */
    public function about()
    {
        return view('about');
    }//end about()
}//end class
