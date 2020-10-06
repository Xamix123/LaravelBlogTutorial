<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $text_post
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $comments
 * @property-read int|null $comments_count
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post query()
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereDescription($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereTextPost($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereUserId($value)
 * @mixin Eloquent
 */
class Post extends Model
{
    use HasFactory;

    public const DEFAULT_NUMBER_POSTS = 5;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'title', 'description', 'text_post'];

    /**
     * @var int
     */
    private $user_id;

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
    public function getCountPosts()
    {
        return Post::get()->count();
    }//end getCountPosts()

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function addCountCommentsByTheListPosts($posts)
    {
        foreach ($posts as $id => $post) {
            $posts[$id]['count'] = $post->comments()->get()->count();
        }

        return $posts;
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @param int $count
     * @return Collection
     */
    public function getLastPosts($count)
    {
        return Post::orderBy('created_at', 'desc')
                ->take($count)
                ->get();
    }//end getLastPosts()
}//end class
