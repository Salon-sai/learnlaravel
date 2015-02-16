<?php

namespace App\Controllers\Restaurant;

use View, Sentry, Order, Response, Input, Log;

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
	 * Remove the specified resource from storage.
	 * DELETE /restaurant\order/{id}
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
		return Response::json(array(
				'type'	=> 'success',
				'message'=> 'success to delete the order'
			));
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
		$restaurant_id = Sentry::getUser()->id;
		switch ($type) {
			case 'check':
				$orders 	= Order::where('status', '<', 0)
					->where('user_id', $restaurant_id)
					->orderBy('status')
					->get();
				$view 		= 'restaurant.order.check';
				break;
			case 'refuse' :
				$orders 	= Order::where('status', 0)
					->where('user_id', $restaurant_id)
					->get();
				$view 		= 'restaurant.order.refuse';
				break;
			case 'deliver':
				$orders 	= Order::where('status', 1)
					->where('user_id', $restaurant_id)
					->get();
				$view 		= 'restaurant.order.deliver';
				break;
			case 'finished':
				$orders 	= Order::where('status', 2)
					->where('user_id', $restaurant_id)
					->get();
				$view 		= 'restaurant.order.finished';
				break;
			default:
				# code...
				break;
		}
		return View::make($view)->with('orders', $orders);
	}

	public function changeOrderState(){
		$id 			= Input::get('order_id');
		$type 			= Input::get('type');
		$order 			= Order::find($id);
		switch ($type) {
			case 'refuse':
				$order->status = 0;
				break;
			case 'accept':
				$order->status = 1;
				break;
			case 'finished':
			{
				$order->status = 2;
				foreach ($order->foods as $food) {
					$quantity = $food->pivot->quantity;
					$food->current_sell += $quantity;
					$food->total_sell += $quantity;
					$food->current_total_store -= $quantity;
					$food->save();
				}
				break;
			}
			default:
				# code...
				Log::info('invoke to the state default');
				return Response::json(array(
						'type' 	=> 'error',
						'message'=> 'fail to change the order status'
					));
				break;
		}
		$order->update();
		return Response::json(array(
				'type'	=> 'success',
				'message'=> 'success to '.$type.' the order'
			));
	}
}