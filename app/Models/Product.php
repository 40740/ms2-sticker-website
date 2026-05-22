<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['category_id', 'name', 'slug', 'type', 'description', 'image', 'hero_title', 'hero_subtitle', 'hero_image', 'features', 'steps_title', 'steps', 'concerns', 'testimonials', 'is_active', 'sort_order'])]
class Product extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'steps' => 'array',
            'concerns' => 'array',
            'testimonials' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the category this product belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the FAQs for this product.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    /**
     * Scope to only active products.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort_order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
