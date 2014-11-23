<?php

class TariffsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 * GET /tariffs
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(Tariff::all()->toArray());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tariffs/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tariffs
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "tariff_code" => "required|numeric",
            "tariff_name" => "required"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Tariff::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /tariffs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Tariff::find($id)->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tariffs/{id}/edit
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
	 * PUT /tariffs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "tariff_code" => "numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Tariff::find($id);
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
	 * DELETE /tariffs/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model=Tariff::find($id);
        if ( $model->delete()){
            return ProcessResponse::$success;
        } else {
            return ProcessResponse::getError(1000, "Error");
        }
	}

}