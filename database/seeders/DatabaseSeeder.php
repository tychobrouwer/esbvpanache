<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        Announcement::factory(10)->create([
            'title' => 'Sample Announcement',
            'date' => now(),
            'content' => 'This is a sample announcement content.',
        ]);

        Activity::factory(10)->create([
            'title' => 'Sample Activity',
            'date' => now()->addDays(10),
            'location' => 'Sample Location',
            'cost' => 'Free',
            'how_to_join' => 'Register online',
            'content' => 'This is a sample activity description.',
        ]);
    }
}
