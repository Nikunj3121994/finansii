<?php

class SubAccountsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /subaccounts
	 *
	 * @return Response
	 */
	public function index()
	{
        $skip=0;
        if(Input::has('skip')){
            $skip=Input::has('skip');
        }
        return ProcessResponse::process(SubAccount::take(20)->skip($skip)->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /subaccounts/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /subaccounts
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "sub_account_code" => "required|numeric",
            "sub_account_name" => "required"
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            if (SubAccount::create(Input::all())) {
                return ProcessResponse::$success;
            } else {
                return ProcessResponse::getError(1000, "Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /subaccounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return ProcessResponse::process(SubAccount::find($id)->first()->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /subaccounts/{id}/edit
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
	 * PUT /subaccounts/{id}
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
            $model=SubAccount::find($id);
            $model->fill(Input::all());
            if ($model->save()) {
                return ProcessResponse::$success;
            } else {
                return ProcessResponse::getError(1000, "Error");
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /subaccounts/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		SubAccount::destroy($id);
        return ProcessResponse::$success;
	}

}