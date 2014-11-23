<?php

class StreetsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 * GET /streets
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Input::has('settlement_code')){
            return ProcessResponse::process(Street::where('settlement_code','=',Input::get('settlement_code'))
                ->whereRaw('street_name LIKE ?',array("%".Input::get('val')."%"))->get());
        }else if(Input::has('val')){
            return ProcessResponse::process(Street::whereRaw('street_name LIKE ?',array("%".Input::get('val')."%"))->get());
        }else {
            return ProcessResponse::process(Street::with('settlements')->get()->toArray());
        }
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /streets/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /streets
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "street_code" => "required|numeric",
            "street_name" => "required",
            "settlement_code" => "required|numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }else{
            if(Street::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /streets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Street::find($id)->first()->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /streets/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /streets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "street_code" => "numeric",
            "settlement_code" => "numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }
        else{
            $model=Street::find($id);
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
	 * DELETE /streets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model=Street::find($id);
        if ( $model->delete()){
            return ProcessResponse::$success;
        } else {
            return ProcessResponse::getError(1000, "Error");
        }
	}

}