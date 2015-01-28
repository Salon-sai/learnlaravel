<?php
namespace App\Validators;

class DescriptionValidator extends Validator {

	public static $rules = array(
		'name'			=> 'required',
		'telephone'		=> 'required|numeric',
		'scale'			=> 'required|numeric',
		'location_label'=> 'required',
		'locationX'		=> 'required|numeric',
		'locationY'		=> 'required|numeric'
	);

}

?>