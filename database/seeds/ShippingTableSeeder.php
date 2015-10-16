<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

use Faker\Factory as Faker;
class ShippingTableSeeder extends Seeder
{
    public function run()
    {
        \Illuminate\Database\Eloquent\Model::unguard();
        DB::statement('set foreign_key_checks = 0');
        DB::table('shipping')->truncate();
        $faker = Faker::create();

        $shippingMethod = ['UPS','USPS','FeDex','DHL'];
        $orderItemsId = \App\Models\OrderItems::all()->lists('id');
        foreach(range(1,200) as $index ){
            $id = $faker->randomElement($orderItemsId);

            if(DB::table('shipping')->where('orderitem_id',$id)->first()) {
                continue;
            }else {
                DB::table('shipping')->insert([
                    'shipping_method' => $faker->randomElement($shippingMethod),
                    'orderitem_id' => $orderItemsId,
                'track_number' => $faker->randomAscii . $faker->randomNumber()
            ]);
            }
        }

        DB::statement('set foreign_key_checks = 1');
    }
}
