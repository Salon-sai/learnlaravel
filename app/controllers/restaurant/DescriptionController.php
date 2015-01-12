<?php

namespace App\Controllers\Restaurant;
use View, Sentry, Notification;
use App\Validators\RestaurantValidator;

class DescriptionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /restaurant/description
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /restaurant/description/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurant/description
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
			$description 				 = Description::find($id);
			$description->name 			 = Input::get('name');
			$description->telephone	  	 = Input::get('telephone');
			$description->scale 		 = Input::get('scale');
			$description->location_label = Input::get('location_label');
			$description->description 	 = Input::get('description');
			// $description->status 		 = Input::get('status');
			$description->save();
			Notification::success('mofity the description success');
			return Redirect::route('admin.restaurant.index');
		}
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
		return View::make('restaurant.description.advanced');
	}
}