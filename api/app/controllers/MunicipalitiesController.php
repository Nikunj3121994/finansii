<?php

class MunicipalitiesController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('only' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Input::has('val')){
            return ProcessResponse::process(Municipality::where('municipality_name','like','%'.Input::get('val').'%')->take(5)->get());
        }
        return ProcessResponse::process(Municipality::all()->toArray());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "municipality_code" => "required|numeric",
            "municipality_name" => "required",
            "municipality_id" => "numeric",
        ));
        Log::info(Input::all());
        if($validator->fails()){
            return ProcessResponse::getError( 1000,$validator->messages());
        }else{
            if(Municipality::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return ProcessResponse::process(Municipality::find($id)->first()->get());
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{



	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "municipality_code" => "numeric",
            "municipality_id" => "numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }
        else{
            $model=Municipality::find($id);
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
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model=Municipality::find($id);
        if ( $model->delete()){
            return ProcessResponse::$success;
        } else {
            return ProcessResponse::getError(1000, "Error");
        }
	}


}
