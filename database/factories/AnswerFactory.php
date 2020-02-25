<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        //
        'question_id' => rand(1, 100),
        'user_id' => rand(1, 100),
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->text($maxNbChars = 200),
    ];
});
