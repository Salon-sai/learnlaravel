<?php

namespace App\Controllers\_Default;

use Cache, Input, View, Redirect;

class CacheController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /_default\cache
	 *
	 * @return Response
	 */
	public function index()
	{
		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /_default\cache/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('test.cache.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /_default\cache
	 *
	 * @return Response
	 */
	public function store()
	{
		$token	= Input::get('_token');
		$data 	= Input::get('data');
		Cache::put($token, $data, 10);
		return View::make('test.cache.storesuccess')->with('token', $token);
	}

	/**
	 * Display the specified resource.
	 * GET /_default\cache/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$token	= Input::get('_token');
		if($token){
			$data 	= Cache::get($token);
			return View::make('test.cache.show')->with('data', $data);
		}else{
			return View::make('test.cache.create');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /_default\cache/{id}/edit
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
	 * PUT /_default\cache/{id}
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
	 * DELETE /_default\cache/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}