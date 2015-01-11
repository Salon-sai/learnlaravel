<?php

class Customer extends \Eloquent {
	protected $fillable = [];

	public function contacts(){
		return $this->hasMany('Contact');
	}

	public function comments(){
		return $this->hasMany('Comment');
	}

	public function orders(){
		return $this->hasMany('Order');
	}
}