<?php
namespace App\Validators;

class FoodValidator extends Validator {

	public static $rules = array(
		'name'		=> 'required',
		'price'		=> 'required|numeric',
	);

}
?>