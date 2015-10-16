<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class VendorsTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        DB::table('vendors')->truncate();

        $faker = Faker::create();

        foreach(range(1,20) as $index ){
            DB::table('vendors')->insert([
                'name' => $faker->company,
                'contact' => $faker->name,
                'phone' => $faker->phoneNumber,
                'fax' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'country_id' => 840,
                'zipcode' => $faker->postcode
            ]);
        }
    }
}
