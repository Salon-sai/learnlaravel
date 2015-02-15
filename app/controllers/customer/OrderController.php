<?php

namespace App\Controllers\Customer;

use BaseController, Input, Food, Order, Session, Contact, Log, View, Response, DB, Notification;

class OrderController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer\order
	 *
	 * @return Response
	 */
	public function index()
	{
		$beginTime  = time();
		$openid 	= Session::get('openid');
		$orders 	= Order::where('openid', $openid)
			->orderBy('status', 'desc')
			->get();
		Log::info('total time : '.(time() - $beginTime).'ms');
		return View::make('customer.order.index')
			->with('orders', $orders);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customer\order/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$beginTime 		= time();
		$ids 			= Input::get('food_ids');
		$quantity_s 	= Input::get('quantity_s');
		$restaurant_id	= Input::get('restaurant_id');
		$total 			= substr(Input::get('total'), 1);
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
			$foodMap 		= Session::pull('foodMap', 'default');
			$restaurant_id	= Session::pull('restaurant_id', 'default');
			$total 			= Session::pull('total');
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
			Session::put('restaurant_id', $restaurant_id);
			Session::put('total', $total);
			Log::info('push the restaurant id to the session');
			Session::put('foodMap', $foodMap);
			Log::info('user '.$openid.' session save the food map ');
			Log::info('redirect to create contact');
			Log::info('That user create order and redeay to redirect to contact use total time : '.(time() - $beginTime).'ms');
			return View::make('customer.contact.create')
				->with(array(
						'RedirectPage' 	=> 'u.order.create',
						'setDefault' 	=> true
					));
		}else{
			Log::info('success get contact');
			$order 			= new Order;
			$order->openid 	= $openid;
			$order->address = $contact->address;
			$order->telephone = $contact->telephone;
			$order->user_id = $restaurant_id;
			$order->total 	= $total;
			$order->save();
			Log::info('success save order');
			$insertlist 	= array();
			for($i = 0; $i < count($id_list); $i++){
				$time 		= date('Y-m-d H:i:s', time());
				array_push($insertlist, array(
					'order_id' 	=> $order->id,
					'food_id'	=> $id_list[$i],
					'quantity'	=> $quantity_list[$i],
					'created_at'=> $time,
					'updated_at'=> $time
				));
			}
			$contacts = Contact::where("openid", $openid)->get();
			foreach ($contacts as $contact) {
				Log::info('the contact address is '.$contact->address);
			}
			DB::table('food_order')->insert($insertlist);
			//the second database opeartion
			Log::info('success save food into order');
			Log::info('That user create order uses total time : '.(time() - $beginTime).'ms');
			return View::make('customer.order.check')
				->with(array(
					'order'		=> $order,
					'contacts'	=> $contacts
					));
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
		Log::info('invoke to the order edit and order id is '.$id);
		$order 		= Order::find($id);
		return View::make('customer.order.check')
			->with('order', $order);
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
		$beginTime 			= time();
		$change_food_id 	= Input::get('change_ids');
		$change_quantity 	= Input::get('change_quantity');
		
		$id_list 			= explode(',', $change_food_id);
		$quantity_list		= explode(',', $change_quantity);
		Log::info('id_list is '.$change_food_id);
		Log::info('quantity list is '.$change_quantity);

		for($i = 0; $i < count($id_list); $i++){
			DB::table('food_order')
				->whereRaw("order_id = ? and food_id = ?", array($id, $id_list[$i]))
				->update(array('quantity' => $quantity_list[$i]));
		}

		$total = 0;
		$order 				= Order::find($id);
		foreach ($order->foods as $food) {
			$total 			+= $food->pivot->quantity * $food->price;
		}
		$order->total 		= $total;
		$order->status 		= -1;
		$order->save();
		Log::info('update time is '.(time() - $beginTime).'ms');
		Notification::success('success to submit the order');
		return View::make('customer.order.submit_success')
			->with('order', $order);
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
		Log::info($id);
		Log::info('destroy method invoke');
		$order 		= Order::find($id);
		$order->delete();
		return Response::json();
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

}
?>