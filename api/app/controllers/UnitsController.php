<?php

class UnitsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /units
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(Unit::all()->toArray());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /units/create
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /units
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "unit_name" => "required",
            "unit_desc" => "required"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Unit::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /units/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Unit::find($id)->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /units/{id}/edit
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
	 * PUT /units/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Unit::find($id);
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
	 * DELETE /units/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Unit::destroy($id);
        return ProcessResponse::$success;
	}

}