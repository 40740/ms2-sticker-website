<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'message', 'file_path', 'page_source', 'is_read'])]
class Inquiry extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    /**
     * Scope to only unread inquiries.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Mark the inquiry as read.
     */
    public function markAsRead(): bool
    {
        return $this->update(['is_read' => true]);
    }
}
