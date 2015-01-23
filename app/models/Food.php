<?php

class Food extends \Eloquent {
	protected $fillable = [];

	public function user(){
		return $this->belongsTo('User');
	}

	public function comments(){
		return $this->hasMany('Comment');
	}

	public function categories(){
		return $this->belongsToMany('Category');
	}

	public function orders(){
		return $this->belongsToMany('Order')
			->withTimestamps()
			->withPivot('quantity');
	}
}