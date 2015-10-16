<?php

use Illuminate\Database\Seeder;
use App\Models\Roles;
// composer require laracasts/testdummy
//use Laracasts\TestDummy\Factory as TestDummy;
class UsersTableSeeder extends Seeder
{
    public function run()
    {
        Eloquent::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('role_users')->truncate();
        DB::table('activations')->truncate();
        DB::table('throttle')->truncate();
        DB::table('persistences')->truncate();
        DB::table('reminders')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $adminrole = [
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => [
                'admin' => true,
                'user.*' => true,
                'order.*' => true,
                'category.*' => true,
                'approval.*' => false,
                'approval.*' => false,
            ]
        ];
        $adminRole = Roles::firstOrNew($adminrole)->save();

        //Manager Role and user
        $role = [
            'name' => 'Manager',
            'slug' => 'manager',
            'permissions' => [
                'admin' => false,
                'user.*' => true,
                'order.*' => true,
                'category.*' => true,
                'approval.*' => true,
            ]
        ];
        $managerRole = Roles::firstOrCreate($role);
//      Sentinel::getRoleRepository()->createModel()->fill($role)->save();

        $role = [
            'name' => 'Member',
            'slug' => 'member',
            'permissions'=>[
                'order.*'=>true
            ]
        ];

        $memberRole = Roles::firstOrCreate($role);

        $admin = [
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email'    => 'admin@example.com',
            'password' => 'password',
            'permissions' => [
                'admin' => true,
                'user.*' => true,
                'order.*' => true,
                'category.*' => true,
                'approval.*' => false,
            ]
        ];

        $adminUser = Sentinel::registerAndActivate($admin);
        $adminUser->roles()->attach($adminRole);

        $managerUsers = [[
            'first_name' => 'Peter',
            'last_name' => 'Du',
            'email' => 'manager@fzbtechnology.com',
            'password' => 'password',
            'permissions' =>[
                    'admin' => false,
                    'user.*' => true,
                    'order.*' => true,
                    'category.*' => true,
                    'approval.*' => true,
                ]
        ]];
        foreach ($managerUsers as $each) {
            $Manager = \Sentinel::registerAndActivate($each);
            $Manager->roles()->attach($managerRole->id);
        }

        //members
        $memberusers = [
            [
                'first_name' => 'demo',
                'last_name' => 'demo',
                'email'    => 'demo1@example.com',
                'password' => 'demo123',
                'permissions' => ['order.*' => true ]
            ],
            [
                'first_name'    =>  'demo',
                'last_name'    =>  '2',
                'email'    => 'demo2@example.com',
                'password' => 'demo123',
                'permissions' => ['order.*' => true ]
            ],
            [
                'first_name'    =>  'demo',
                'last_name'    =>  '3',
                'email'    => 'demo3@example.com',
                'password' => 'demo123',
                'permissions' => ['order.*' => true ]
            ],
        ];


        foreach ($memberusers as $user)
        {
            $member = Sentinel::registerAndActivate($user);
            $member->roles()->attach($memberRole->id);
        }

        $faker = Faker\Factory::create();

        foreach(range(1,10) as $index ){
            $fakeruser = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email'      => $faker->safeEmail,
                'password'  => $faker->password(6),
                'permissions' => ['order.*' => true]
            ];

            $user = Sentinel::registerAndActivate($fakeruser);
            $user->roles()->attach($memberRole->id);
        }
    }
}
