<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Model;
use App\Models\Categories;
use Faker\Factory as Faker;

class CategoriesSeederTableSeeder extends Seeder
{

    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('categories')->truncate();

        $faker = Faker::create();
        $categories =[
            ['name' => 'Lab',
            'description' => 'Lab room'],
            ['name' => 'Office',
                'description' => 'Office room'],
            ['name' => 'Toolroom',
                'description' => 'Toolroom room'],
            ['name' => 'Machining',
            'description' => 'Machining room'],
            ['name' => 'Other',
             'description' => 'For other usage']
        ];

        foreach($categories as $category ) {
            DB::table('categories')->insert(
                [
                    'name' => $category['name'] ,
                    'description' => $category['description']
                ]
            );
        }

        foreach(range(1,10) as $index){

            DB::table('categories')->insert([
                'name'  => ucwords($faker->text(20)),
                'description' => $faker->text()
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
