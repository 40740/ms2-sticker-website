<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AssignCategoryGroupsSeeder extends Seeder
{
    /**
     * Category groups are now included in the initial data migration
     * with explicit category_group values per category record.
     *
     * This seeder is intentionally left empty.
     */
    public function run(): void
    {
        // No-op - category_group is set in the populate_initial_data migration
    }
}
