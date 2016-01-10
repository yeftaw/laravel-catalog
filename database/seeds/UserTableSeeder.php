<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('users')->truncate();

        DB::table('users')->insert([
			'name'     => "Administrator",
			'email'    => 'admin@gmail.com',
			'password' => bcrypt('admin'),
			'role_id'     => 1
        ]);

        DB::table('users')->insert([
            'name'     => "Customer",
            'email'    => 'customer@gmail.com',
            'password' => bcrypt('customer'),
            'role_id'     => 2
        ]);
    }
}
