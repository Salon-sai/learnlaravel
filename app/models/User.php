<?php


class User extends \Cartalyst\Sentry\Users\Eloquent\User {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function description(){
		return $this->hasOne('Description');
	}

	public function group(){
		return $this->belongsTo('Group');
	}
}
