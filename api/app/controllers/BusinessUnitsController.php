<?php

class BusinessUnitsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 * GET /businessunits
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(BusinessUnit::with('companies')->app()->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /businessunits/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /businessunits
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
                "company_code" => "required|numeric",
                "business_unit_code" => "required|numeric",
                "business_unit_name" => "required",
                "business_unit_type" => "required",
                "business_unit_account" => "required"
            ));
            if($validator->fails()){
                return ProcessResponse::getError(1000,$validator->messages());
            }else{
                if(BusinessUnit::create(Input::all())){
                    return ProcessResponse::$success;
                }else{
                    return ProcessResponse::getError( 1000,"Error");
                }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /businessunits/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(BusinessUnit::find($id)->with('companies')->app()->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /businessunits/{id}/edit
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
	 * PUT /businessunits/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "company_code" => "numeric",
            "business_unit_code" => "numeric",
            "business_unit_type" => "numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=BusinessUnit::find($id);
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
	 * DELETE /businessunits/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		BusinessUnit::destroy($id);
	}

}