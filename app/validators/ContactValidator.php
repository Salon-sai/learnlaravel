<?php

namespace App\Validators;

class ContactValidator extends Validator {

	public static $rules = array(
		'address' 	=> 'required',
		'telephone'	=> 'required|numeric',
	);

}

?>