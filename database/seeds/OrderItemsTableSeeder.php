<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
class OrderItemsTableSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('orderitems')->truncate();

        $faker = Faker::create();

        $orders = \App\Models\Orders::all()->lists('id');
        $vendors = \App\Models\Vendors::all()->lists('id');
        $categories = \App\Models\Categories::all()->lists('id');

        foreach(range(1,20) as $index){

            $quantity = $faker->numberBetween(1,20);
            $price = $faker->randomFloat(2,1,5000);
            $finalprice = $faker->randomFloat(2,1,5000);
            DB::table('orderitems')->insert([
                'name' => $faker->name,
                'order_id' => $faker->randomElement($orders),
                'category_id' => $faker->randomElement($categories),
                'vendor_id' => $faker->randomElement($vendors),
                'description' => $faker->text(),
                'url'           => $faker->url,
                'quantity'      => $quantity,
                'estimatedprice' => $price,
                'estimatedtotal' => ($price * $quantity),
                'fixedprice' => $finalprice,
                'fixedtotal' => ($finalprice * $quantity),
                'status'        => 0,
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
