<?php

class OperatorsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /operators
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(Operator::all()->toArray());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /operators/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /operators
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "operator_name" => "required",
            "operator_pass" => "required",
            "operator_mail" => "mail",
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }else{
            if(Operator::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /operators/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Operator::find($id)->first()->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /operators/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /operators/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "operator_mail" => "mail",
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }else{
            $model=Operator::find(1);

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
	 * DELETE /operators/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Operator::destroy($id);
        return ProcessResponse::$success;
	}

}