<?php

class Description extends \Eloquent {
	protected $fillable = [];

	//status = 1 : Open
	//status = 0 : Close
	//status = -1 : has not been checked

	public function user(){
		return $this->hasOne('User');
	}
}