<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\Post::factory(10)->create();
        // \App\Models\Product::factory(15)->create();

        // 1. Создаем 4 базовые категории
        $categories = [
            \App\Models\Category::create(['name' => 'Электроника', 'slug' => 'electronics']),
            \App\Models\Category::create(['name' => 'Одежда', 'slug' => 'clothes']),
            \App\Models\Category::create(['name' => 'Книги', 'slug' => 'books']),
        ];

        // 2. Для каждой категории генерируем по 5 случайных товаров через фабрику
        foreach ($categories as $category) {
            \App\Models\Product::factory(5)->create([
                'category_id' => $category->id // Принудительно задаем ID созданной категории
            ]);
        }
    }
}
