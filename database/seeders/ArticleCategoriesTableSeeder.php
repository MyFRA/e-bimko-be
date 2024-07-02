<?php

namespace Database\Seeders;

use App\Models\ArticleCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleCategoriesTableSeeder extends Seeder
{
    private $categories = ['Kesehatan', 'Tips & Trik', 'Berita', 'Outdoor Learning'];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->categories as $category) {
            ArticleCategory::create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}
