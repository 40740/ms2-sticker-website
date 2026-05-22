<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class AssignCategoryGroupsSeeder extends Seeder
{
    /**
     * Assign category_group to existing categories based on their slug.
     * This ensures backward compatibility while supporting the new navigation structure.
     */
    public function run(): void
    {
        // Material categories mapping
        $materialCategories = [
            'vinyl-stickers', 'paper-stickers', 'pet-labels', 'pp-labels', 'pvc-labels',
            'kraft-labels', 'foil-labels', 'transparent-labels', 'holographic-stickers',
            'metallic-stickers', 'thermal-labels', 'removable-stickers'
        ];

        // Industry categories mapping
        $industryCategories = [
            'brewery-labels', 'cosmetic-labels', 'candle-labels', 'food-beverage-labels',
            'pharma-labels', 'cannabis-labels', 'coffee-labels', 'wine-labels',
            'amazon-labels', 'logistics-labels', 'chemical-labels', 'electronics-labels'
        ];

        // Shape categories mapping
        $shapeCategories = [
            'die-cut-stickers', 'kiss-cut-stickers', 'circle-stickers', 'rectangle-stickers',
            'square-stickers', 'oval-stickers', 'star-stickers', 'heart-stickers',
            'custom-shape-stickers', 'roll-labels', 'sheet-labels', 'cut-to-size-labels'
        ];

        // Update Material categories
        foreach ($materialCategories as $slug) {
            Category::where('slug', $slug)->update(['category_group' => 'material']);
        }

        // Update Industry categories
        foreach ($industryCategories as $slug) {
            Category::where('slug', $slug)->update(['category_group' => 'industry']);
        }

        // Update Shape categories
        foreach ($shapeCategories as $slug) {
            Category::where('slug', $slug)->update(['category_group' => 'shape']);
        }

        // Update remaining sticker categories to 'sticker' group
        $stickerTypeIds = Category::where('type', 'sticker')
            ->whereNull('category_group')
            ->pluck('id');
        foreach ($stickerTypeIds as $id) {
            Category::where('id', $id)->update(['category_group' => 'sticker']);
        }

        // Update remaining label categories to 'label' group
        $labelTypeIds = Category::where('type', 'label')
            ->whereNull('category_group')
            ->pluck('id');
        foreach ($labelTypeIds as $id) {
            Category::where('id', $id)->update(['category_group' => 'label']);
        }

        $this->command->info('Category groups assigned successfully!');
    }
}
