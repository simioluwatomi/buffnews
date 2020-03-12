<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\News;
use App\Models\User;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    return [
        'publisher_id' => function () {
            return factory(User::class)->create()->id;
        },
        'category_id' => function () {
            return factory(Category::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body'  => $faker->paragraph($nbSentences = 10, $variableNbSentences = true),
    ];
});
