<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function role()
	{
		return $this->hasOne('App\Role', 'id', 'role_id');
	}

	public function is($roleName)
	{
		if($this->role->name == $roleName)
		{
			return true;
		}

		return false;
	}

	public function hasRole($roles, $requireAll = false)
	{
		foreach ($roles as $role) {
			if ($this->role->name == $role) return true;
		}

		return false;
	}

}
