<?php

class PartnersController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 * GET /partners
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(Partner::with('municipalities')->with('settlements')->with('streets')->app()->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /partners/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /partners
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "partner_code" => "required|numeric",
            "partner_name" => "required",
            "settlement_code" => "required|numeric",
            "municipality_code" => "required|numeric",
            "street_code" => "required|numeric",
            "mail"=>"email"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Partner::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /partners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Partner::find($id)->first()->with('municipalities')->
            with('settlements')->with('streets')->app()->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /partners/{id}/edit
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
	 * PUT /partners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "partner_code" => "numeric",
            "settlement_code" => "numeric",
            "municipality_code" => "numeric",
            "street_code" => "numeric",
            "mail"=>"email"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Partner::find($id);
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
	 * DELETE /partners/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Partner::destroy($id);
	}

}