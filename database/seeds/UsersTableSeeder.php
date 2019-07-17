<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
        	'name'     => 'Sadam Hussain',
        	'email'    =>  'sadam.uom7@gmail.com',
        	'password' =>bcrypt('smstar'),

        ]);
    }
}
