<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Topic::class, function (Faker $faker) {
    $sentence = $faker->sentence();
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    
    return [
        'title' => $sentence,
        'body' => implode("\n\n", $faker->paragraphs(mt_rand(3, 6))),
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at
    ];
});
