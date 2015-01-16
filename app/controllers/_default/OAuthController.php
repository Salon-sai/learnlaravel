<?php

namespace App\Controllers\_Default;

use BaseController, Input;

class OAuthController extends BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /_default\oauth
	 *
	 * @return Response
	 */
	public function index()
	{
		$code = Input::get('code');
		if($code)
			return $code;
		else
			return 'NO CODE';
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /_default\oauth/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /_default\oauth
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /_default\oauth/{id}
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
	 * GET /_default\oauth/{id}/edit
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
	 * PUT /_default\oauth/{id}
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
	 * DELETE /_default\oauth/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}