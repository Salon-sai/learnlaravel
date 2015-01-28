<?php

namespace App\Controllers\Restaurant;

use Input, View, BaseController;

class RegisterController extends BaseController {


	/**
	 * Show the form for creating a new resource.
	 * GET /restaurant/register/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('restaurant.auth.register');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /restaurant/register
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	public function storeDescription(){
		
	}
}