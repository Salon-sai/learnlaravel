<?php

namespace App\Controllers\Admin;

use View, Sentry, User, DB, Log, Input, Description, Redirect, Notification;

class RestaurantController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /admin/restauratn
	 *
	 * @return Response
	 */
	public function index()
	{
		$restaurantGroup = Sentry::findGroupById(6);
		$restaurants = Sentry::findAllUsersInGroup($restaurantGroup);
		return View::make('admin.restaurant.index')
			->with('restaurants', $restaurants);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /admin/restauratn/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /admin/restauratn
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /admin/restauratn/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$restaurant = User::find($id);
		return View::make('admin.restaurant.show')
			->with('restaurant', $restaurant);
	}

	public function checkDetail($id){
		$restaurant = User::find($id);
		return View::make('admin.restaurant.checkdetail')
			->with('restaurant', $restaurant);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /admin/restauratn/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /admin/restauratn/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/restauratn/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function findApplication(){
		$select_sql = "select users.id, descriptions_0.name, users.email, descriptions_0.location_label from users inner join (select * from descriptions where status = -1) descriptions_0 on descriptions_0.user_id = users.id;";
		$restaurants= DB::select($select_sql);
		Log::info("invoke to the find application");
		return View::make('admin.restaurant.checkApplication')
			->with('restaurants', $restaurants);
	}

	public function agressApplication()
	{
		$id = Input::get('r_id');
		$description = Description::where("user_id", $id)->first();
		$description->status = 0;
		$description->save();
		Notification::success('agree the application !');
		return Redirect::route("admin.r.findapplication");
	}
}