<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['email', 'source', 'is_active', 'subscribed_at', 'unsubscribed_at'])]
class Subscriber extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'subscribed_at' => 'datetime',
            'unsubscribed_at' => 'datetime',
        ];
    }

    /**
     * Scope to only active subscribers.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to only inactive (unsubscribed) subscribers.
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    /**
     * Subscribe or re-activate an email.
     * If already exists and inactive, re-activate it.
     * If already exists and active, do nothing (return existing).
     * If not exists, create new.
     */
    public static function subscribe(string $email, string $source = 'newsletter'): self
    {
        $subscriber = static::where('email', $email)->first();

        if ($subscriber) {
            if (!$subscriber->is_active) {
                $subscriber->update([
                    'is_active' => true,
                    'source' => $source,
                    'subscribed_at' => now(),
                    'unsubscribed_at' => null,
                ]);
            }
            return $subscriber;
        }

        return static::create([
            'email' => $email,
            'source' => $source,
            'is_active' => true,
            'subscribed_at' => now(),
        ]);
    }

    /**
     * Unsubscribe an email.
     */
    public function unsubscribe(): bool
    {
        return $this->update([
            'is_active' => false,
            'unsubscribed_at' => now(),
        ]);
    }
}
