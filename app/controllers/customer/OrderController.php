<?php

namespace App\Controllers\Customer;

use BaseController, Input;

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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customer\order
	 *
	 * @return Response
	 */
	public function store()
	{
		$ids 		= Input::get('food_ids');
		$quantity_s = Input::get('quantity_s');
		$total		= 0;
		
		$id_list 		= explode(',', $ids);
		$quantity_list	= explode(',', $quantity_s);

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