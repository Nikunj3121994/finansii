<?php

class ExchangeRatesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /exchangerates
	 *
	 * @return Response
	 */
	public function index()
	{
        $skip=0;
        if(Input::has('skip')){
            $skip=Input::has('skip');
        }
        return ProcessResponse::process(ExchangeRate::take(20)->skip($skip)->with('currency')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /exchangerates/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /exchangerates
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "exchange_date" => "required",
            "currency_code" => "required|numeric",
            "currency_value"=>"required|numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            if (ExchangeRate::create(Input::all())) {
                return ProcessResponse::$success;
            } else {
                return ProcessResponse::getError(1000, "Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /exchangerates/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return ProcessResponse::process(ExchangeRate::find($id)->currency()->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /exchangerates/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /exchangerates/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "currency_code" => "numeric",
            "currency_value"=>"numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            $model=ExchangeRate::find($id);
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
	 * DELETE /exchangerates/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		ExchangeRate::destroy($id);
        return ProcessResponse::$success;
	}

}