<?php

namespace App\Controllers\Admin;

use View, Sentry, User;

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

}