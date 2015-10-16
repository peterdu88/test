<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comments;
use Faker\Factory as Faker;

class CommentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('comments')->truncate();

        DB::table('comments')->insert([
            'orderitem_id' => $faker->numberBetween(1,20),
            'content'   => $faker->text($maxNbChars = 200)
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
