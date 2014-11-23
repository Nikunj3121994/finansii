<?php

class BanksController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 * GET /banks
	 *
	 * @return Response
	 */
	public function index()
	{
		return ProcessResponse::process(Bank::all()->toArray());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /banks/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /banks
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "bank_bic" => "required|numeric",
            "bank_name" => "required"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Bank::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /banks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return ProcessResponse::process(Bank::find($id)->first());
    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /banks/{id}/edit
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
	 * PUT /banks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "bank_bic" => "numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Bank::find($id);
            $model->fill(Input::all());
            if($model->save()){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /banks/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model=Bank::find($id);
        if ( $model->delete()){
            return ProcessResponse::$success;
        } else {
            return ProcessResponse::getError(1000, "Error");
        }
	}

}