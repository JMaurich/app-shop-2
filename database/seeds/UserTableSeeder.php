<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
			'name'=> 'Joselo',
			'email'=> 'jmaurich@gmail.com',
			'password'=> bcrypt('123123'),
            'admin' => true,
        ]);
    }
}
