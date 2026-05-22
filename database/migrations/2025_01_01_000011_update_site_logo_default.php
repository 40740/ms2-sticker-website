<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Update site_logo default value from empty string to /images/logo.png
     */
    public function up(): void
    {
        DB::table('settings')
            ->where('key', 'site_logo')
            ->where(function ($query) {
                $query->where('value', '')
                    ->orWhereNull('value');
            })
            ->update(['value' => '/images/logo.png']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse this
    }
};
