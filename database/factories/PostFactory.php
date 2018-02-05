<?php 
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker)
	{

    return [
    	'post_type' =>rand(0, 1) ? 'Stage' : 'Formation',
        'title' => $faker->sentence(2),
        'description' => $faker->paragraph(),
        'started_at'=> $faker->dateTimeBetween($startDate = 'now', $endDate = '+7 days', $timezone = null),
        'ended_at' => $faker->dateTimeBetween($startDate = '+7 days', $endDate = '+14 days', $timezone = null),
        'price' => $faker->numberBetween($min = 500, $max = 2500),
        'student_max' => $faker->numberBetween($min = 10, $max = 50),
    ];
});

