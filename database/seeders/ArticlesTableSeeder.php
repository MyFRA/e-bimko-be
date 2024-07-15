<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            $faker = Factory::create('en_EN');
            $title = $faker->realText(50);

            Article::create([
                'article_category_id' => ArticleCategory::inRandomOrder()->first()->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'thumbnail' => 'article.jpg',
                'content' => $faker->realText(500)
            ]);
        }
    }
}
