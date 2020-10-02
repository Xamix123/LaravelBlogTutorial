<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;

    /**
     * @var int
     */
    private $id_user;

    /**
     * @var int
     */
    private $id_post;

    /**
     * @var string
     */
    private $text_comment;

    /**
     * @param  integer $idPost
     *
     * @return integer
     */
    public static function getCountCommentsForPost($idPost)
    {
        return DB::table('comments')->where('id_post', '=', $idPost)->count();
    }//end getCountCommentsForPost()

    /**
     * @param  $idPost
     *
     * @return Collection
     */
    public static function getCommentList($idPost)
    {
        return DB::table('comments')->where('id_post', '=', $idPost)->get();
    }//end getCommentList()

    public static function deleteCommentList($idPost)
    {
        return DB::table('comments')->where('id_post', '=', $idPost)->delete();
    }//end deleteCommentList()
}//end class
