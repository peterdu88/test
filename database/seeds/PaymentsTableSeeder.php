<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class PaymentsTableSeeder extends Seeder {

	public function run()
	{
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('payments')->truncate();


		$faker = Faker::create();
		foreach(range(1, 20) as $index) {
            $this->command->info($faker->creditCardType);

            $total = DB::table('payments')->where('name', $faker->creditCardType)->first();

            if (!$total){
                DB::table('payments')->insert(
                    array(
                        'name' => $faker->creditCardType,
                        'description' => $faker->text(),
                        'status' => 1
                    )
                );
            }

        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}