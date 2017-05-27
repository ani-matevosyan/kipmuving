<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
	public $table = 'roles';

	public function permissions()
	{
		return $this->belongsToMany('App\Permission', 'permission_role', 'role_id', 'permission_id');
	}

	public function setPermissionsAttribute($permissions)
	{
		$this->permissions()->detach();
		if ( !$permissions) return;
		if ( !$this->exists) $this->save();
		$this->permissions()->attach($permissions);
	}

	public function getPermissionsAttribute($permissions)
	{
		return array_pluck($this->permissions()->get(['id'])->toArray(), 'id');
	}
}
