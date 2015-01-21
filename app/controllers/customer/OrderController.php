<?php

namespace App\Controllers\Customer;

use BaseController, Input, Food, Order, Session, Contact, Log;

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
		if(!$ids && !$quantity_s){
			if($ids){
				$id_list 	= explode(',', $ids);
				Log::info('success to generate the id list '.$id_list);
			}else{
				$id_list	= array();
				Log::info('ids is empty');
			}
			if($quantity_s){
				$quantity_list= explode(',', $quantity_s);
				Log::info('success to generate the quantity list '.$quantity_list);
			}else{
				$quantity_list= array();
				Log::info('quantity_s is empty');
			}
		}
		$openid 	= Session::get('openid');

		$contacts 	= Contact::whereRaw('openid = ? and default = true', array($openid))
			->first();
		if(!$contacts){
			for(var $i = 0; $i < count($id_list); $i++){
				$foodMap[$id_list[$i]] = $quantity_list[$i];
			}
			Session::push('foodMap', $foodMap);
			Log::info('user '.$openid.' session save the food map : '.$foodMap);
			Log::info('redirect to create contact');
			return View::make('customer.contact.create')
				->with('RedirectPage', 'u.order.create');
		}else{
			$contact 		= $contacts->get();
			Log::info('success get contact');
			$order 			= new Order;
			$order->openid 	= $openid;
			$order->address = $contact->address;
			$order->telephone = $contact->telephone;
			$order->user_id = $restaurant_id;
			$order->save();
			Log::info('success save order');
			$foods  		= array();
			foreach ($id_list as $id) {
				$food 		= Food::find($id);
				$total		+= $food->price;
				array_push($foods, $food);
			}
			$order->foods()->saveMany($foods);
			Session::forget('foodMap');
			Log::info('success save food into order and remove food map in the session');
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