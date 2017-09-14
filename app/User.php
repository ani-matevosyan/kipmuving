<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use EntrustUserTrait;
	use Notifiable;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username',
		'first_name',
		'last_name',
		'gender',
		'birthday',
		'phone',
		'avatar',
		'confirmation_code',
		'confirmed',
		'email',
		'password',
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	public function reservations()
	{
		return $this->hasMany(Reservation::class, 'user_id', 'id');
	}

	public function special_offers()
	{
		return $this->hasMany(SpecialOffer::class, 'user_id', 'id')
			->where('special_offers.active', true)
			->where('created_at', '>', Carbon::now()->subDays(3)->toDateTimeString());
	}
	
	public function getAvatarAttribute()
	{
		return ($this->attributes['avatar'] === null)
			? asset('images/image-none.jpg')
			: $this->attributes['avatar'];
	}

//	public function getUser($id)
//	{
//		$user = User::find($id);
//		return $user;
//	}
}
