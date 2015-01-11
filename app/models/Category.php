<?php

class Category extends \Eloquent {
	protected $fillable = [];

	public function foods(){
		return $this->belongsToMany('Food');
	}
}