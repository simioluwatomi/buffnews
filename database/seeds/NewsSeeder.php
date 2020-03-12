<?php

use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();

        Category::all()->each(function ($category) use ($users) {
            factory(News::class, 15)->create([
                'category_id'  => $category->id,
                'publisher_id' => $users->random()->id,
            ]);
        });
    }
}
