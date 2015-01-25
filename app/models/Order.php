<?php

class Order extends \Eloquent {
	protected $fillable = [];

	/** 
	*			status define
	*	status = -2 not confirm
	*	status = -1 customer confirm but restaurant not accept
	*	status = 0  restaurant refuse the order
	*	status = 1 	restaurant accept the order and ready to deliver
	*	status = 2  finished the order
	*
	**/

	public function foods(){
		return $this->belongsToMany('Food')
			->withTimestamps()
			->withPivot('quantity');
	}

	public function customer(){
		return $this->belongsTo('Customer');
	}
}