<?php

namespace App\Validators;

class RegisterValidator extends Validator {

	public static $rules = array(
		'email'		=> 'required|email|unique:users',
		'password'	=> 'required|confirmed'
	);

}
?>