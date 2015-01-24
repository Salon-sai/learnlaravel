<?php

namespace App\Controllers\Customer;

use BaseController, Sentry, View, Description, Food, Log;
use Session, Customer;

class RestaurantController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer\restaurant
	 *
	 * @return Response
	 */
	public function index()
	{
		$openid 	= Session::get('openid');
		Log::info('the openid is '.$openid);
		$customer 	= Customer::where('openid', $openid)
			->first();
		if(!$customer || empty($customer)){
			$customer= new Customer;
			$customer->openid = $openid;
			$customer->save();
			Log::info('success to save customer and the id is '.$customer->id);
		}
		$descriptions 	= Description::where('status', '<>', 9)
			->orderBy('status', 'desc')->get();
		return View::make('customer.restaurant.index')
			->with('descriptions', $descriptions);
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
	 * @param  int  $id of description
	 * @return Response
	 */
	public function show($id)
	{
		$description= Description::find($id);
		Log::info($description->user_id);
		$foods 		= Food::where('user_id', '=', $description->user_id)
			->orderBy('status', 'desc')->get();
		return View::make('customer.restaurant.foodlist')
			->with(array(
					'description' 	=> $description,
					'foods'			=> $foods
				));
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
?>