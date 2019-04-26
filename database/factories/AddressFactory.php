<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {

	    return [

	    	'client_id' =>  rand(1,150),
	       	'address' => $faker->address,
	       	'locality' => $faker->city,
	       	'province' => $faker->state,
	       	'phone_number' => $faker->unique()->phoneNumber,
	       	'nextel_number' => $faker->unique()->phoneNumber,
	       	'cell_number' => $faker->unique()->phoneNumber,
	    ];
});
