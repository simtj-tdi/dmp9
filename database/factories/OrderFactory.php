<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        //
        'user_id' => rand(1, 4),
        'pyament_id' => rand(1, 4),
        'state' => rand(1, 2),
        'types' => $faker->randomElement($array = array ('naver','instagram','facebook', 'kakao')),
        'data_name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'data_count' => $faker->numberBetween($min = 1000, $max = 5000),
        'buy_price' => $faker->numberBetween($min = 1000, $max = 5000),
        'buy_date'=> $faker->date($format = 'Y-m-d', $timezone = "Asia/Seoul"),
        'expiration_date'=> $faker->date($format = 'Y-m-d', $timezone = "Asia/Seoul"),
    ];
});
