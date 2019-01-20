<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AccountsTableSeeder::class);
        $this->call(BuildingsTableSeeder::class);

    }
}


class UsersTableSeeder extends Seeder
{

    public function run()
    {

        $users = [
            [
                'id' => 1,
                'name'=>'Admin',
                'email'=>'admin@hms.com',
                'password' =>Hash::make('123456'),
            ]
        ];

        app('db')->table('users')->delete();
        app('db')->table('users')->insert($users);
    }

}



class AccountsTableSeeder extends Seeder
{

    public function run()
    {

        $accounts = [
            [
                'id' => 1,
                'name'=>'Mohamed Elorbany',
                'email'=>'mohamed@hms.com',
                'phone' => '+966545258964',
                'password' =>Hash::make('123456'),
                'user_id' =>1
            ],
            [
                'id' => 2,
                'name'=>'Ibrahim Adnan',
                'email'=>'ibrahim@hms.com',
                'phone' => '+966545258965',
                'password' =>Hash::make('123456'),
                'user_id' =>1
            ],
        ];

        app('db')->table('accounts')->delete();
        app('db')->table('accounts')->insert($accounts);
    }
}


class BuildingsTableSeeder extends Seeder
{

    public function run()
    {

        $buildings = [
            [
                'id' => 1,
                'account_id'=>1,
                'title'=>'Home',
                'type'=>'flat',
                'latitude'=>24.786036,
                'longitude'=>46.778012,
                'address'=>'3222 Antakyah, Ishbiliyah, Riyadh 13225 7056',
                'user_id' =>1
            ],
            [
                'id' => 2,
                'account_id'=>2,
                'title'=>'Company',
                'type'=>'villa',
                'latitude'=>24.812368,
                'longitude'=>24.812368,
                'address'=>'7508 Najah، Al Yarmuk, Riyadh 13251 4305',
                'user_id' =>1
            ],
        ];

        app('db')->table('buildings')->delete();
        app('db')->table('buildings')->insert($buildings);
    }
}