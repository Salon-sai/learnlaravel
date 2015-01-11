<?php

namespace App\Controllers\_Default;

use Sentry, Redirect, View, Input;

class AuthController extends \BaseController {

	public function getLogin($type){
		if(Sentry::check()){
			if(Sentry::getUser()->hasAccess('manager'))
				return Redirect::to('admin/');
			else if(Sentry::getUser()->hasAccess('restaurant'))
				return Redirect::to('restaurant/');
		}
		if($type == 'admin')
			return View::make('admin.auth.login');
		else if($type == 'r')
			return View::make('restaurant.auth.login');
	}

	public function postLogin($type){
		$credentials = array(
			'email'		=> Input::get('email'),
			'password'	=> Input::get('password')
		);
		try{
			$user = Sentry::authenticate($credentials, false);
			
			if($user) {
				if($user->hasAccess('restaurant') && $type == 'r')
					return Redirect::route('r.order.index');
				else if($user->hasAccess('manager') && $type == 'admin')
					return Redirect::route('admin.restaurant.index');
				else 
					return Redirect::back()
						->withErrors(array('login' => 'The Login Type is invalidation'));
			}

		}catch(\Exception $e){
			return Redirect::back()
				->withErrors(array('login' => $e->getMessage()));
		}
	}

	public function Logout(){
		$user = Sentry::getUser();
		if($user->hasAccess('manager')){
			Sentry::Logout();
			return Redirect::to('login/admin');
		}else if($user->hasAccess('restaurant')){
			Sentry::Logout();
			return Redirect::to('login/r');
		}
	}

}