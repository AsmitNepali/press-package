<?php

use Illuminate\Support\Str;
use Vicgonvt\Press\Post;

$factory->define(Post::class, function (\Faker\Generator $faker) {
    return [
        'identifier' => $faker->uuid,
        'slug' => $faker->slug,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'extra' => json_encode(['test' => 'value'])
    ];
});