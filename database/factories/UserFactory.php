<?php
use App\Helper;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(User::class, function (Faker $faker) {
    $randomDate = Helper::getRandomRegisterDate();
    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'created_at' => $randomDate['created'],
        'updated_at' => $randomDate['created'],
        'email_verified_at' => $randomDate['verified'],
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
        'remember_token' => Str::random(10),
        'api_token' => Str::random(64)
    ];
});
