<?php

namespace App\Controllers\Customer;

use BaseController, Sentry, View;

class RestaurantController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer\restaurant
	 *
	 * @return Response
	 */
	public function index()
	{
		$restaurantGroup = Sentry::findGroupById(6);
		$restaurants 	 = Sentry::findAllUsersInGroup($restaurantGroup);
		return View::make('customer.restaurant.index')
			->with('restaurants', $restaurants);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customer\restaurant/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customer\restaurant
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /customer\restaurant/{id}
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
	 * GET /customer\restaurant/{id}/edit
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
	 * PUT /customer\restaurant/{id}
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
	 * DELETE /customer\restaurant/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}