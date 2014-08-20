<?php

class AccountsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /accounts
	 *
	 * @return Response
	 */
	public function index()
	{
        $skip=0;
        if(Input::has('skip')){
            $skip=Input::has('skip');
        }
        return ProcessResponse::process(Account::take(20)->skip($skip)->with('subAccounts')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /accounts/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /accounts
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "sub_account_code" => "required|numeric",
            "account_name" => "required",
            "account_type" => "required"
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            if (Account::create(Input::all())) {
                return ProcessResponse::$success;
            } else {
                return ProcessResponse::getError(1000, "Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /accounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return ProcessResponse::process(Account::find($id)->with('subAccounts')->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /accounts/{id}/edit
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
	 * PUT /accounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "sub_account_code" => "numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            $model=Account::find($id);
            if ($model->fill(Input::all())) {
                $model->save();
                return ProcessResponse::$success;
            } else {
                return ProcessResponse::getError(1000, "Error");
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /accounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Account::destroy($id);
        return ProcessResponse::$success;
	}

}