<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example: php artisan make:admin
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     */
    protected $description = 'Create a new admin user with the provided name, email, and password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->ask('Enter admin name');
        $email = $this->ask('Enter admin email');
        $password = $this->secret('Enter admin password');

        if (User::where('email', $email)->exists()) {
            $this->error("A user with email {$email} already exists.");
            return 1;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("✅ Admin user '{$name}' created successfully with email {$email}.");
    }
}
