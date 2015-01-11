<?php

class Comment extends \Eloquent {
	protected $fillable = [];

	public function food(){
		return $this->belongsTo('Food');
	}

	public function customer(){
		return $this->belongsTo('Customer');
	}
}