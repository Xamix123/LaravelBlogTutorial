<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_post
 * @property string $text_comment
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Comment newModelQuery()
 * @method static Builder|Comment newQuery()
 * @method static Builder|Comment query()
 * @method static Builder|Comment whereCreatedAt($value)
 * @method static Builder|Comment whereId($value)
 * @method static Builder|Comment whereIdPost($value)
 * @method static Builder|Comment whereIdUser($value)
 * @method static Builder|Comment whereTextComment($value)
 * @method static Builder|Comment whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $user_id
 * @property int $post_id
 * @method static Builder|Comment wherePostId($value)
 * @method static Builder|Comment whereUserId($value)
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'post_id', 'text_comment'];


    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function deleteCommentList($idPost)
    {
        return DB::table('comments')->where('id_post', '=', $idPost)->delete();
    }//end deleteCommentList()
}//end class
