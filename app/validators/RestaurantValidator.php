<?php
namespace App\Validators;

class RestaurantValidator extends Validator {

	public static $rules = array(
		'name'			=> 'required',
		'telephone'		=> 'required|numeric',
		'scale'			=> 'required|numeric',
		'location_label'=> 'required'
	);

}
?>