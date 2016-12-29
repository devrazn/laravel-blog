<?php 

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->unique()->text($maxNbChars = 255),
        'body' => $faker->text($maxNbChars = 3000),
        'slug' => $faker->unique($reset = true)->numberBetween($min = 1, $max = 9999)
    ];
});