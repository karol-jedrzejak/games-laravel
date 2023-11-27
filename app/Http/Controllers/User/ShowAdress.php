<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Faker\Factory;

class ShowAdress extends Controller
{
    public function __invoke(int $id)
    {
        $faker = Factory::create();
        $adress = ['street' => $faker->streetName(),
        'postcode' => $faker->postcode(),
    ];


        return view('user.adress',['adress' => $adress]);
    }
}
