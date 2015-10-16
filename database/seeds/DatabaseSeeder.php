<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        $this->call('UsersTableSeeder');
        $this->command->info('User table seeded!');
        $this->call('CategoriesSeederTableSeeder');
        $this->command->info('Categories table seeded!');

        $this->call('VendorsTableSeeder');
        $this->command->info('Vendors table seeded!');
        $this->call('ApprovalsTableSeeder');
        $this->call('CommentsTableSeeder');
        $this->call('PaymentsTableSeeder');
        $this->command->info('Payments table seeded!');
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');
        $this->call('OrderTableSeeder');
        $this->command->info('Seeded the Orders!');
        $this->call('OrderItemsTableSeeder');
        $this->command->info('Seeded the OrderItems!');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

	}

}