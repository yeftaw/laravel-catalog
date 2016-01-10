<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class RoleTableSeeder extends Seeder{

	public function run()
	{
		DB::table('roles')->truncate();

		Role::create([
			'id'          => 1,
			'name'        => 'admin',
			'description' => 'Full access to create, edit, and update companies, and orders.'
		]);

		Role::create([
			'id'          => 2,
			'name'        => 'customer',
			'description' => 'A standard user that can have a licence assigned to them. No administrative features.'
		]);
	}

}
