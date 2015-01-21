<?php

namespace App\Validators;

class ContactValidator extends Validator {

	public static $rules = array(
		'Address' 	=> 'required',
		'telephone'	=> 'required|numeric',
	);

}

?>