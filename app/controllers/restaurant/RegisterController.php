<?php

namespace App\Controllers\Restaurant;

use Input, View, BaseController, Sentry, Log, Mail, Redirect, App\Validators\RegisterValidator;

class RegisterController extends BaseController {


	/**
	 * Show the form for creating a new resource.
	 * GET /restaurant/register/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('restaurant.auth.register');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurant/register
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator 		= new RegisterValidator;
		if($validator->passes()){
			$email 		= Input::get('email');
			$password 	= Input::get('password');
			$user 		= Sentry::register(array(
					'email'		=> $email,
					'password'	=> $password
				));
			Log::info('success to register the restaurant user id : '.$user->id);
			$activationCode	= $user->getActivationCode();
			$data		= array(
					'activationCode'	=> $activationCode,
					'id'				=> $user->id
				);
			Mail::send('emails.auth.register_confirm', $data, function($message) use ($email){
				Log::info('readry to send the email to the '.$email);
				$message->from('coke1231078@gmail.com', 'FoodOrder');
				$message->to($email)->subject('Food Order Active By GMail');
			});
			return View::make('restaurant.auth.waittingactivationCode');
		}else{
			Log::info('input is invalidated');
			return Redirect::back()
				->withInput()->withErrors($validator->errors);
		}
	}
}