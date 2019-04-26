<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {

    return [
       'code' => str_pad(rand(1,150),6,"0",STR_PAD_LEFT), 
       'name' => $faker->name, 
       'razon_social' => $faker->company, 
       'nickname' => $faker->text(8), 
       'email' => $faker->unique()->safeEmail, 
       'birth_date' => $faker->dateTime(), 
       'reference' => $faker->text(30), 
       'cp' => $faker->word(4), 
       'cuit' => $faker->word(8), 
       'tax' => $faker->randomFloat(2), 
    ];
});
