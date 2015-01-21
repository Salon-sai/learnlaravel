<?php

namespace App\Controllers\_Default;

use Input, Session, Redirect, View;

class SessionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /_default\session
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /_default\session/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('test.session.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /_default\session
	 *
	 * @return Response
	 */
	public function store()
	{
		$data 	= Input::get('data');
		Session::put('data', $data);
		return Redirect::route('test.session.show',0);
	}

	/**
	 * Display the specified resource.
	 * GET /_default\session/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Session::get('data');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /_default\session/{id}/edit
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
	 * PUT /_default\session/{id}
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
	 * DELETE /_default\session/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}