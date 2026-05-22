<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class EnsureAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'admin:ensure {--email=admin@meisaiprinting.com} {--password=password} {--reset}';

    /**
     * The console command description.
     */
    protected $description = 'Create or reset the admin user for backend login';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->option('email');
        $password = $this->option('password');
        $reset = $this->option('reset');

        if ($reset) {
            $user = User::where('email', $email)->first();
            if ($user) {
                $user->update([
                    'password' => bcrypt($password),
                    'is_admin' => true,
                ]);
                $this->info("Admin user password reset: {$email}");
            } else {
                $this->warn("No user found with email: {$email}. Creating new admin user.");
                User::create([
                    'name' => 'Admin',
                    'email' => $email,
                    'password' => bcrypt($password),
                    'is_admin' => true,
                    'email_verified_at' => now(),
                ]);
                $this->info("Admin user created: {$email}");
            }
        } else {
            $user = User::where('email', $email)->where('is_admin', true)->first();
            if ($user) {
                $this->info("Admin user already exists: {$email}");
            } else {
                User::create([
                    'name' => 'Admin',
                    'email' => $email,
                    'password' => bcrypt($password),
                    'is_admin' => true,
                    'email_verified_at' => now(),
                ]);
                $this->info("Admin user created: {$email}");
            }
        }

        $this->newLine();
        $this->info("Login credentials:");
        $this->line("  Email:    {$email}");
        $this->line("  Password: {$password}");
        $this->line("  Login URL: " . url('/admin/login'));

        return self::SUCCESS;
    }
}
