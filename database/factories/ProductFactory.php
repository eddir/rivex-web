<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
    ];
});
