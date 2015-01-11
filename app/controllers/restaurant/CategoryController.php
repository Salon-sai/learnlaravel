<?php

namespace App\Controllers\Restaurant;

use Category, View, DB, Sentry;

class CategoryController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /restaurant/category
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();
		return View::make('restaurant.category.index')
			->with('categories', $categories);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /restaurant/category/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurant/category
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /restaurant/category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$foods = DB::table('foods')
			->join('category_food', 'category_food.categoyr_id', '=', $id)
			->where('user_id', '=', Sentry::getUser()->id)
			->get();
		return View::make("restaurant.category.show");
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /restaurant/category/{id}/edit
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
	 * PUT /restaurant/category/{id}
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
	 * DELETE /restaurant/category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}