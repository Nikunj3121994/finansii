<?php

class SettlementsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /settlements
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('municipalities')){
            return ProcessResponse::process(Settlement::where('municipality_code','=',Input::get('municipalities'))->toArray());
        }else{
            return ProcessResponse::process(Settlement::with('municipalities')->get()->toArray());
        }
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /settlements/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /settlements
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "settlement_code" => "required|numeric",
            "settlement_name" => "required",
            "ptt_code" => "numeric",
            "municipality_code" => "required|numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }else{
            if(Settlement::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /settlements/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Settlement::find($id)->first()->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /settlements/{id}/edit
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
	 * PUT /settlements/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "settlement_code" => "numeric",
            "ptt_code" => "numeric",
            "municipality_code" => "numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            $model=Settlement::find($id);
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
	 * DELETE /settlements/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model=Settlement::find($id);
        if ( $model->delete()){
            return ProcessResponse::$success;
        } else {
            return ProcessResponse::getError(1000, "Error");
        }
	}

}