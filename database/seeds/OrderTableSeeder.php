<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Faker\Factory as Faker;
class OrderTableSeeder extends Seeder
{
    public function run()
    {

        $faker = Faker::create();

        $usersId = \App\Models\User::all()->lists('id');
        foreach(range(0,20) as $index){
            DB::table('orders')->insert([
                'user_id' => $faker->randomElement($usersId),
                'specialInstruction' => $faker->text(),
                'status'    => 1
            ]);
        }
    }
}
