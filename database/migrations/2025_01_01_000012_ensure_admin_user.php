<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Ensure an admin user exists for backend login.
     */
    public function up(): void
    {
        // Only create if no admin user exists
        if (!User::where('is_admin', true)->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@funstickers.com',
                'password' => bcrypt('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Don't delete the admin user on rollback
    }
};
