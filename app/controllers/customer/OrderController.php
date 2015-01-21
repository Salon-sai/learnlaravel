<?php

namespace App\Controllers\Customer;

use BaseController, Input, Food, Order, Session, Contact;

class OrderController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer\order
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customer\order/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$ids 			= Input::get('food_ids');
		$quantity_s 	= Input::get('quantity_s');
		$restaurant_id	= Input::get('restaurant_id');
		$foodMap 		= array();
		$total			= 0;
		if($ids){
			$id_list 	= explode(',', $ids);
		}else{
			$id_list	= array();
		}
		if($quantity_s){
			$quantity_list= explode(',', $quantity_s);
		}else{
			$quantity_list= array();
		}
		$openid 		= Session::get('openid');

		$contacts 	= Contact::where('openid', = , $openid)
			->where('default', = , 1);
			->get();
		if(!$contacts){
			for(var $i = 0; $i < count($id_list); $i++){
				$foodMap[$id_list[$i]] = $quantity_list[$i];
			}
			Session::push('foodMap', $foodMap);
			return View::make('u.contact.create')
				->with('RedirectPage', 'u.order.');
		}else{
			$order 			= new Order;
			$order->openid 	= $openid;
			$order->address = $contact->address;
			$order->telephone = $contact->telephone;
			$order->user_id = $restaurant_id;
			$order->save();
			$foods  		= array();
			foreach ($id_list as $id) {
				$food 		= Food::find($id);
				$total		+= $food->price;
				array_push($foods, $food);
			}
			$order->foods()->saveMany($foods);
			return View::make('u.order.check')->with('order', $order);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customer\order
	 *
	 * 
	 * @return Response
	 */
	public function store()
	{

	}

	/**
	 * Display the specified resource.
	 * GET /customer\order/{id}
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
	 * GET /customer\order/{id}/edit
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
	 * PUT /customer\order/{id}
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
	 * DELETE /customer\order/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function saveInCache(){

	}
}