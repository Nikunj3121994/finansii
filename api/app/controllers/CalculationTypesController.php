<?php

class CalculationTypesController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 * GET /calculationtypes
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(CalculationType::all());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /calculationtypes/create
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /calculationtypes
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "calculation_type_code" => "required|numeric",
            "calculation_type_name" => "required"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(CalculationType::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /calculationtypes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		ProcessResponse::process(CalculationType::find($id)->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /calculationtypes/{id}/edit
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
	 * PUT /calculationtypes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "calculation_type_code" => "numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=CalculationType::find($id);
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
	 * DELETE /calculationtypes/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		CalculationType::destroy($id);
	}

}