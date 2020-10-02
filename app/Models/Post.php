<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    public const DEFAULT_NUMBER_POSTS = 5;

    /**
     * @var int
     */
    private $id_author;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var int
     */
    private $text_post;

    /**
     * @return integer
     */
    public static function getCountPosts()
    {
        return DB::table('posts')->count();
    }//end getCountPosts()

    /**
     * @param int $count
     * @return Collection
     */
    public static function getLastPosts($count)
    {
        return DB::table('posts')->orderBy('created_at', 'DESC')->limit($count)->get();
    }//end getLastPosts()
}//end class
