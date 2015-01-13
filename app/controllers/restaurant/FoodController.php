<?php

namespace App\Controllers\Restaurant;

use View, Food, Sentry, Category, Notification, Redirect, Input;
use App\Validators\FoodValidator, DB, Response;

class FoodController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /restaurant/food
	 *
	 * @return Response
	 */
	public function index()
	{
		$foods = Food::where('user_id', '=', Sentry::getUser()->id)
			->get();
		return View::make('restaurant.food.index')
			->with('foods', $foods);

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /restaurant/food/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$categories = Category::all();
		return View::make('restaurant.food.create')
			->with('categories', $categories);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurant/food
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new FoodValidator;

		if($validation->passes()){
			$food				= new Food;
			$food->current_sell = 0;
			$food->total_sell 	= 0; 
			$this->saveOrupdate($food);
			Notification::success('create new food success');
			return Redirect::route('r.food.index');
		}
		return Redirect::back()
			->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /restaurant/food/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$food 	= Food::find($id);
		return View::make('restaurant.food.show')
			->with('food', $food);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /restaurant/food/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$food = Food::find($id);
		$categories = Category::all();
		return View::make('restaurant.food.edit')
			->with('food', $food)
			->with('categories', $categories);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /restaurant/food/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validation = new FoodValidator;

		if($validation->passes()){
			$food 				= Food::find($id);
			$this->saveOrupdate($food);
			Notification::success('update food success');
			return Redirect::route('r.food.index');
		}
		return Redirect::back()
			->withInput()->withErrors($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /restaurant/food/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$food = Food::find($id);
		$message = '';
		$orders = $food->orders;
		if(count($orders) == 0 && !$food->status){
			$food->delete();
			return Response::json(array(
					'message' => ' Delete Action is success .',
					'type'	  => 'success'
				));
		}
		if(count($orders) != 0)
			$message = ' There are order include this food .';
		if($food->status)
			$message = $message.' The food is grounding .';
		return Response::json(array(
				'message' => $message,
				'type'	  => 'error'
			));
	}

	public function changestatus(){
		$food = Food::find(Input::get('id'));
		$food->status = !$food->status;
		$food->save();
		if($food->status)
			return Response::json(array(
				'message' => 'success to grounding the food',
				'type'	  => 'success'
			));
		else
			return Response::json(array(
				'message' => 'success to undercarriaged the food',
				'type'	  => 'success'
			));
	}


	/**
	*	需要算法优化 2015.1.11
	*
	**/
	public function saveOrupdate($food){
		$food->name 		= Input::get('name');
		$food->price 		= Input::get('price');
		$food->description 	= Input::get('description');
		$food->current_total_store= Input::get('store');
		$food->total_sell 	+= $food->current_sell;
		$food->current_sell = 0;
		$food->user_id 		= Sentry::getUser()->id;
		$food->picture		= 'dir';
		$categoriesId		= Input::get('categoriesId');
		$categories 		= $food->categories;
		// I need to fix it 2015.1.13
		if(Input::get('status'))
			$food->status = 1;
		else
			$food->status = 0;
		foreach ($categoriesId as $categoryId) {
			$flag = true; //判断是否存在相同的category id
			foreach ($categories as $category) {
				if($category->id == $categoryId){
					$flag = false;
					break;
				}
			}
			if(!$food->id){
				$food->save();
			}
			if($flag)
				$food->categories()->save(Category::find($categoryId));
		}
	}
}