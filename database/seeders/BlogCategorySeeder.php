<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $createdAt = now()->subDays(110);

        BlogCategory::factory()->create(
            [
                'name' => 'Cookery',
                'active' => true,
                'sort_order' => 1,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );

        BlogCategory::factory()->create(
            [
                'name' => 'Fashion',
                'active' => true,
                'sort_order' => 2,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );

        BlogCategory::factory()->create(
            [
                'name' => 'Food',
                'active' => true,
                'sort_order' => 3,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );

        BlogCategory::factory()->create(
            [
                'name' => 'Home',
                'active' => true,
                'sort_order' => 4,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );

        BlogCategory::factory()->create(
            [
                'name' => 'Leisure',
                'active' => true,
                'sort_order' => 5,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );

        BlogCategory::factory()->create(
            [
                'name' => 'Technology',
                'active' => true,
                'sort_order' => 6,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );

        BlogCategory::factory()->create(
            [
                'name' => 'Transport',
                'active' => true,
                'sort_order' => 7,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );

        BlogCategory::factory()->create(
            [
                'name' => 'Travel',
                'active' => true,
                'sort_order' => 8,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        );
    }
}
