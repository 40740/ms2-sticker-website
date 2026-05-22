<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'excerpt', 'content', 'image', 'meta_title', 'meta_description', 'is_published', 'published_at'])]
class BlogPost extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    /**
     * Scope to only published posts.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope to order by published date (newest first).
     */
    public function scopeLatestPublished($query)
    {
        return $query->orderBy('published_at', 'desc');
    }
}
