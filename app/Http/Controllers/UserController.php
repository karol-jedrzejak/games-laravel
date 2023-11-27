<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = [];
        $faker = Factory::create();
        $count = $faker->randomNumber(1, false);

        for ($i=0; $i < $count; $i++) {
            $users[] = [
                'id' => $faker->randomNumber(2, false),
                'name' => $faker->firstNameMale()
            ];
        }

        $session = $request->session();
        $session->put('prevAction',__METHOD__.':'.time());


        $session->flash('FlasshTestParam','Byłem Tu');
/*         dump($session); */

        return view('user.list',['users' => $users]);
    }

    public function show(Request $request,int $userId)
    {
         $prevAction = $request->session(
        )->get('prevAction');
/*         dump($prevAction); */

        // Czyszczenie sesji
        /* $request->session()->flush(); */



        $request->session()->put('test_tt',null);
/*         dump($request->session()->has('test_tt'));
        dump($request->session()->exists('test_tt'));

        dump($request->session()->get('FlasshTestParam')); */

        $faker = Factory::create();
        $user = ['id' => $userId,
        'name' => $faker->firstNameMale(),
        'lastname' => $faker->lastName(),
        'city' => $faker->city(),
        'age' => $faker->randomNumber(2, false),
        'html' => '<script>alert("hack")</script>',
    ];

        return view('user.show',['user' => $user]);
    }

    public function show_helper(Request $request,int $userId)
    {
        session(['testtt2' => 'tesett']);
        $prevAction = session('prevAction');
/*         dump($prevAction); */

        // Czyszczenie sesji
        /* $request->session()->flush(); */



        $request->session()->put('test_tt',null);
/*         dump($request->session()->has('test_tt'));
        dump($request->session()->exists('test_tt'));

        dump($request->session()->get('FlasshTestParam')); */

        $faker = Factory::create();
        $user = ['id' => $userId,
        'name' => $faker->firstNameMale(),
        'lastname' => $faker->lastName(),
        'city' => $faker->city(),
        'age' => $faker->randomNumber(2, false),
        'html' => '<script>alert("hack")</script>',
    ];

        return view('user.show',['user' => $user]);
    }
}
