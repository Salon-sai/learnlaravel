<?php

class Order extends \Eloquent {
	protected $fillable = [];

	public function foods(){
		return $this->belongsToMany('Food');
	}

	public function customer(){
		return $this->belongsTo('Customer');
	}
}