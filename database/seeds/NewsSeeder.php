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
        $admins = User::whereHas('role', function ($query) {
            $query->where('name', 'admin');
        })->get();

        Category::all()->each(function ($category) use ($admins) {
            factory(News::class, 15)->create([
                'category_id'  => $category->id,
                'publisher_id' => $admins->random()->id,
            ]);
        });
    }
}
