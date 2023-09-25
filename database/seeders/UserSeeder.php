<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    // use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = bcrypt('Demo1234');
        $createdAt = now()->subDays(110);

        // Create admin user
        User::factory()->create([
            'name' => 'Jane Richards',
            'email' => 'admin1@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_SUPER_ADMIN', 'ROLE_EDITOR', 'ROLE_MODERATOR', 'ROLE_ADMIN']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        // Create editor user
        User::factory()->create([
            'name' => 'Lizzie Jones',
            'email' => 'editor1@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_EDITOR', 'ROLE_ADMIN']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        // Create moderator user
        User::factory()->create([
            'name' => 'Kelly Stephens',
            'email' => 'moderator1@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_MODERATOR', 'ROLE_ADMIN']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        // create bloggers
        User::factory()->create([
            'name' => 'Robert Walker',
            'email' => 'blogauthor1@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_BLOGGER']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        User::factory()->create([
            'name' => 'Venessa Hall',
            'email' => 'blogauthor2@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_BLOGGER']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        User::factory()->create([
            'name' => 'Karen Young',
            'email' => 'blogauthor3@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_BLOGGER']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        User::factory()->create([
            'name' => 'Madeleine Allen',
            'email' => 'blogauthor4@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_BLOGGER']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        User::factory()->create([
            'name' => 'Bethany Harris',
            'email' => 'blogauthor5@example.com',
            'password' => $password,
            'roles' => json_encode(['ROLE_BLOGGER']),
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        // Create users
        User::factory()->create([
            'name' => 'Mary Smith',
            'email' => 'user1@example.com',
            'password' => $password,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        User::factory()->create([
            'name' => 'John Richards',
            'email' => 'user2@example.net',
            'password' => $password,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);
    }
}
