<?php

namespace App\Controllers\Restaurant;

use View, Sentry, Order, Response, Input;

class OrderController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /restaurant/order
	 *
	 * @return Response
	 */
	public function index()
	{	
		$restaurant = Sentry::getUser();
		$orders 	= Order::where('user_id', $restaurant->id)
			->orderBy('status', 'desc')
			->get();
		return View::make('restaurant.order.index')
			->with('orders', $orders);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /restaurant/order/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return 'restaurant has no promises to create the order';
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurant/order
	 *
	 * @return Response
	 */
	public function store()
	{
		return 'restaurant has no promises to store the order';
	}

	/**
	 * Display the specified resource.
	 * GET /restaurant/order/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /restaurant/order/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	public function findOrderByType($type){
		$orders 	= null;
		$view 		= null;
		switch ($type) {
			case 'check':
				$orders 	= Order::where('status', '<', 0)
					->orderBy('status')
					->get();
				$view 		= 'restaurant.order.check';
				break;
			case 'refuse' :
				$orders 	= Order::where('status', 0)->get();
				$view 		= 'restaurant.order.refuse';
				break;
			case 'deliver':
				$orders 	= Order::where('status', 1)->get();
				$view 		= 'restaurant.order.deliver';
				break;
			case 'finished':
				$orders 	= Order::where('status', 2)->get();
				$view 		= 'restaurant.order.finished';
				break;
			default:
				# code...
				break;
		}
		return View::make($view)->with('orders', $orders);
	}

	public function finishedOrder(){
		$order_id 		= Input::get('id');
		$order 			= Order::find($id);
		$order->status  = 2;
		$order->update();
		return Response::json(array(
				'type'	=>'success',
				'message'=>'success finished Order'
			));
	}

	public function acceptOrder(){
		$id 			= Input::get('order_id');
		$order 			= Order::find($id);
		$order->status 	= 1;
		$order->update();
		return Response::json(array(
				'type'	=>'success',
				'message'=>'accept the order'
			));
	}

	public function refuseOrder(){
		$id 			= Input::get('order_id');
		$order 			= Order::find($id);
		$order->status 	= 0;
		$order->update();
		return Response::json(array(
				'type'	=>'success',
				'message'=>'refuse the order'
			));
	}
}