<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'image',
        'category',       // display label, e.g. "Web Development"
        'category_slug',  // e.g. "web-development" — used for filtering
        'read_minutes',
        'user_id',        // author
        'views_count',
        'likes_count',
        'comments_count',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views_count'  => 'integer',
        'likes_count'  => 'integer',
        'comments_count' => 'integer',
    ];

    /**
     * The article's author.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * All likes on this article (one row per user).
     */
    public function likes(): HasMany
    {
        return $this->hasMany(ArticleLike::class);
    }

    /**
     * All comments on this article, newest first.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(ArticleComment::class)->latest();
    }

    /**
     * Whether the given user has liked this article.
     */
    public function isLikedBy(?int $userId): bool
    {
        if (! $userId) {
            return false;
        }

        return $this->likes()->where('user_id', $userId)->exists();
    }




    public function scopeApproved($query)
{
    return $query->where('status', 'approved');
}
 
/**
 * Awaiting admin review. Used by the admin approval screen.
 */
public function scopePending($query)
{
    return $query->where('status', 'pending');
}
}