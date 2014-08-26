<?php

class LedgersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /ledgers
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('order_id')){
            $array=Ledger::with('company')->with('order')->with('currency')->where('order_id','=',Input::get('order_id'))->get();
            return ProcessResponse::process($array);
        }else{
            return ProcessResponse::getError(1000,"Order id required");
        }
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ledgers/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ledgers
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "company_code" => "required|numeric",
            "order_id" => "required|numeric",
            "sub_account" => "required|numeric",
            "booking_type" => "required|numeric",
            "amount" => "required|numeric",
            "currency_code"=>"required|numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Ledger::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /ledgers/{id}
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
	 * GET /ledgers/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /ledgers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "company_code" => "numeric",
            "order_id" => "numeric",
            "sub_account" => "numeric",
            "booking_type" => "numeric",
            "amount" => "numeric",
            "currency_code"=>"numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Ledger::find($id);
            if($model->fill(Input::all())){
                $model->save();
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /ledgers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Ledger::destroy($id);
	}

}