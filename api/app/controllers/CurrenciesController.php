<?php

class CurrenciesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /currencies
	 *
	 * @return Response
	 */
	public function index()
	{
        $skip=0;
        if(Input::has('skip')){
            $skip=Input::has('skip');
        }
        return ProcessResponse::process(Currency::take(20)->skip($skip)->with('exchangeRates')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /currencies/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /currencies
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "currency_shrt_name" => "required",
            "currency_name" => "required",
            "currency_country"=>"required",
            "currency_unit"=>"numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            if (Currency::create(Input::all())) {
                return ProcessResponse::$success;
            } else {
                return ProcessResponse::getError(1000, "Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /currencies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return ProcessResponse::process(Currency::find($id));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /currencies/{id}/edit
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
	 * PUT /currencies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "currency_unit"=>"numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            $model=Currency::find($id);
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
	 * DELETE /currencies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Currency::destroy($id);
        return ProcessResponse::$success;
	}

}