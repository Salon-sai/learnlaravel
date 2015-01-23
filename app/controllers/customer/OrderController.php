<?php

namespace App\Controllers\Customer;

use BaseController, Input, Food, Order, Session, Contact, Log, View, Response, DB;

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
		$id_list		= array();
		$quantity_list	= array();
		$total			= 0;
		if($ids && $quantity_s){
			if($ids){
				$id_list 	= explode(',', $ids);
				Log::info('success to generate the id list '.$ids);
			}else{
				Log::info('ids is empty');
			}
			if($quantity_s){
				$quantity_list= explode(',', $quantity_s);
				Log::info('success to generate the quantity list '.$quantity_s);
			}else{
				Log::info('quantity_s is empty');
			}
		}else if(Session::has('foodMap')){
			$ordersMap 		= Session::pull('foodMap', 'default');
			$restaurant_id	= Session::pull('restaurant_id', 'default');
			foreach ($foodMap as $id => $quantity) {
				array_push($id_list, $id);
				array_push($quantity_list, $quantity);
			}
		}
		$openid 	= Session::get('openid');
		$contact 	= Contact::whereRaw('openid = ? and isDefault = true', array($openid))
			->first();
		if(!$contact){
			$foodMap 		= array();
			for($i = 0; $i < count($id_list); $i++){
				$foodMap[$id_list[$i]] = $quantity_list[$i];
			}
			Session::push('restaurant_id', $restaurant_id);
			Log::info('push the restaurant id to the session');
			Session::push('foodMap', $foodMap);
			Log::info('user '.$openid.' session save the food map ');
			Log::info('redirect to create contact');
			return View::make('customer.contact.create')
				->with('RedirectPage', 'u.order.create');
		}else{
			Log::info('success get contact');
			$order 			= new Order;
			$order->openid 	= $openid;
			$order->address = $contact->address;
			$order->telephone = $contact->telephone;
			$order->user_id = $restaurant_id;
			$order->save();
			Log::info('success save order');
			$insertlist 	= array();
			for($i; $i < count($id_list); $i++){
				$food 		= Food::find($id_list[$i]);
				$total		+=$food->price;
				array_push($insertlist, array(
					'order_id' 	=> $order->id,
					'food_id'	=> $food->id,
					'quantity'	=> $quantity_list[$i]
				));
			}
			DB::table('food_order')->insert($insertlist);
			Log::info('success save food into order');
			return View::make('u.order.check')
				->with('orders', $orders);
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

	public function foodDelete(){
		$order_id 	= Input::get('order_id');
		$food_id 	= Input::get('food_id');

		DB::table('food_order')
			->whereRaw("order_id = ? and food_id = ?", array($order_id, $food_id))
			->delete();

		return Response::json(array(
				'message' 	=> 'Delete the food',
				'type' 		=> 'success'
			));
	}

	public function updateFood(){
		$order_id 			= Input::get('order_id');
		$change_food_id 	= Input::get('change_ids');
		$change_quantity = Input::get('change_quantity');
		
		for($i; $i < count($change_food_id); $i++){
			DB::table('food_order')
				->whereRaw("order_id = ? and food_id = ?", array($order_id, $change_food_id[$i]))
				->update(array('quantity' => $change_quantity[$i]));
		}
		return View::make('customer.order.submit_success');
	}
}

?>