<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = [4, 5, 6, 7];
        $totalCategories = 8;
        $totalBlogs = 100;
        $startDayAgo = 105;

        // Create 100 blog posts with random user_id and category
        foreach (range(1, $totalBlogs) as $i) {
            // increment created_at and updated_at by 1 day starting from 105 days ago
            $createdAt = now()->subDays($startDayAgo - $i);

            BlogPost::factory()->create(
                [
                    'user_id' => $userIds[array_rand($userIds)],
                    'blog_category_id' => rand(1, $totalCategories),
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ]
            );
        }
    }
}
