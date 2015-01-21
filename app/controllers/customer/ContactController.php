<?php

namespace App\Controllers\Customer;

use Input, Redirect, View, Session, Contact, Notification, OAuthService;
use App\Validators\ContactValidator;

class ContactController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /customer/contact
	 *	
	 * http://
	 * @return Response
	 */
	public function index()
	{
		$openid 	= Session::get('openid');
		if(!$openid){
			$oauth 	= new OAuthService;
			$openid	= $oauth->getOpenid();
		}
		$contacts 	= Contact::where('openid', $openid)
			->orderBy('default', 'desc')->get();
		if(!$contacts || empty($contacts)){
			Notification::error('There is no contact.You must create the new one');
			return View::make('customer.contact.create');			
		}
		else
			return View::make('customer.contact.index')
				->with('contacts', $contacts);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /customer/contact/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('customer.contact.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /customer/contact
	 *
	 * @return Response
	 */
	public function store()
	{
		$validation = new ContactValidator;
		if($validation->passes()){
			$contact 			= new Contact;
			$openid 			= Session::get('openid');
			$contact->address 	= Input::get('address');
			$contact->telephone	= Input::get('telephone');
			if(!Contact::whereRaw('openid = ? and default = true', array($openid))->get())
				$contact->default = true;
			$contact->save();
			Notification::success('create new contact success');
		}
		return Redirect::back()
			->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /customer/contact/{id}
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
	 * GET /customer/contact/{id}/edit
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
	 * PUT /customer/contact/{id}
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
	 * DELETE /customer/contact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}