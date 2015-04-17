<?php

namespace App\Controllers\Restaurant;
use View, Sentry, Notification, Description, Input, Redirect, Response;
use App\Validators\RestaurantValidator, Log;
use App\Validators\DescriptionValidator;

class DescriptionController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /restaurant/description/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('restaurant.description.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurant/description
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new DescriptionValidator;
		if($validation->passes()){
			$description = new Description;
			$this->saveORupdateDescription($description);
			if($description->id != null){
				$user = Sentry::getUser();
				$user->description_id = $description->id;
				$user->save();
			}
			Notification::success('store the description success');
			Log::info('invoke to the description store');
			return Redirect::route('r.order.index');
		}
		Log::info(implode(',', $validator->messages()));
		return Redirect::back()
			->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /restaurant/description/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /restaurant/description/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('restaurant.description.edit')
			->with('restaurant', Sentry::getUser());
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /restaurant/description/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new RestaurantValidator;
		if($validation->passes()){
			$description = Description::find($id);
			$this->saveORupdateDescription($description);
			Notification::success('mofity the description success');
			Log::info('invoke to the description update');
			return Redirect::route('r.order.index');
		}
		Log::info(implode(',', $validator->messages()));
		return Redirect::back()
			->withInput()->withErrors($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /restaurant/description/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function advancedSetting(){
		return View::make('restaurant.description.advancedsetting');
	}

	public function changestatus(){
		$description = Sentry::getUser()->description;
		$current_status = $description->status;
		if($description->status == -2)
		{
			return Response::json(array(
					'type'		=> 'error',
					'message' 	=> 'Your Application has not been checked'
				));
		}
		$description->status = !$current_status;
		$description->save();
		return Response::json(array(
			'type' 		=> 'success',
			'message'	=> 'success to change the restaurant stataus'
		));
	}

	private function saveORupdateDescription($description){
		$description->name 			 = Input::get('name');
		$description->telephone	  	 = Input::get('telephone');
		$description->scale 		 = Input::get('scale');
		$description->location_label = Input::get('location_label');
		$description->description 	 = Input::get('description');
		$description->locationX		 = Input::get('locationX');
		$description->locationY		 = Input::get('locationY');
		$description->user_id		 = Sentry::getUser()->id;
		$description->status 		 = -1;
		// if(Input::get('status'))
		// 	$description->status 	 = 1;
		// else
		// 	$description->status 	 = 0;
		$description->save();
	}
}