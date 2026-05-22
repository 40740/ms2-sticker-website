<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'type', 'category_group', 'description', 'image', 'hero_title', 'hero_subtitle', 'hero_image', 'is_active', 'sort_order'])]
class Category extends Model
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
            'sort_order' => 'integer',
        ];
    }

    /**
     * Get the products for this category.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the FAQs for this category.
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(Faq::class);
    }

    /**
     * Scope to only active categories.
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

    /**
     * Scope to filter by category_group.
     */
    public function scopeByGroup($query, string $group)
    {
        return $query->where('category_group', $group);
    }

    /**
     * Scope to filter by type (sticker/label).
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }
}
