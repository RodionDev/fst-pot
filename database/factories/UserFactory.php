<?php
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
$factory->define(User::class, function (Faker $faker) {
    $randomCreatedAt = Carbon::now();
    $randomCreatedAt
        ->subDays(rand(2,144))
        ->setHours(rand(0,23))
        ->setMinutes(rand(0,59))
        ->setSeconds(rand(0,59));
    $randomVerifiedAt = $randomCreatedAt->copy()->addMinutes(rand(2,30));
    return [
        'username' => $faker->userName,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'created_at' => $randomCreatedAt,
        'updated_at' => $randomCreatedAt,
        'email_verified_at' => $randomVerifiedAt,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
        'remember_token' => Str::random(10),
        'api_token' => Str::random(32)
    ];
});
