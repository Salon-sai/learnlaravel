<?php

namespace App\Controllers\_Default;

use Sentry, Redirect, View, Input, Log, DB;

class AuthController extends \BaseController {

	public function getLogin($type){
		if(Sentry::check()){
			if(Sentry::getUser()->hasAccess('manager'))
				return Redirect::to('admin/');
			else if(Sentry::getUser()->hasAccess('restaurant'))
				return Redirect::to('r/');
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
				if($user->hasAccess('restaurant') && $type == 'r'){
					$description	= DB::table('descriptions')
						->where('user_id',$user->id)->get();
					if($description)
						return Redirect::route('r.order.index');
					else
						return Redirect::route('r.description.create');
				}else if($user->hasAccess('manager') && $type == 'admin'){
					return Redirect::route('admin.restaurant.index');
				}else{
					return Redirect::back()
						->withErrors(array('login' => 'The Login Type is invalidation'));
				}				
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

	public function EmailConfirm($code, $id){
		//add the user into the group
		$restaurantGroup= Sentry::findGroupById(6);
		$activeUser		= Sentry::findUserById($id);

		// $now			= time();
		// need to create time limition
		if($activeUser->attemptActivation($code)){
			//activation is success
			Log::info('active the user : '.$id);
			if($activaUser->addGroup($restaurantGroup)){
				Log::info('add the user into the restaurant  id : '.$id);
				$credentials 	= array(
						'email'		=> $activeUser->email,
						'password'	=> $activeUser->password
					);
				$user 			= Sentry::authenticate($credentials, false);
				return Redirect::route('r.description.create');
			}else{
				Log::info('fail to add the user into the restaurant');
			}
		}else{
			//activation is fail
			Log::info('fail to active the user : '.$id);
			return Response::view('fail to active the user', array(), 404);
		}
	}
}