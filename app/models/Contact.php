<?php

class Contact extends \Eloquent {
	protected $fillable = [];

	public function customers(){
		return $this->belongsTo('Customer');
	}
}