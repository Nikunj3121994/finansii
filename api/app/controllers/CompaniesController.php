<?php

class CompaniesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /companies
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(Company::with('municipalities')->with('settlements')->with('streets')->app()->get()->toArray());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /companies/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /companies
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "company_code" => "required|numeric",
            "company_name" => "required",
            "settlement_code" => "required|numeric",
            "municipality_code" => "required|numeric",
            "street_code" => "required|numeric",
            "mail"=>"email"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Company::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(Company::find($id)->first()->with('municipalities')->
            with('settlements')->with('streets')->app()->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /companies/{id}/edit
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
	 * PUT /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "company_code" => "numeric",
            "settlement_code" => "numeric",
            "municipality_code" => "numeric",
            "street_code" => "numeric",
            "mail"=>"email"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Company::find($id);
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
	 * DELETE /companies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $model=Company::find($id);
        if ( $model->delete()){
            return ProcessResponse::$success;
        } else {
            return ProcessResponse::getError(1000, "Error");
        }
	}
    public function addBank(){
        $validator=Validator::make(Input::all(),array(
            'bank'=>'required|numeric',
            'company'=>'required|numeric',
            'bank_account'=>'required|numeric',
            'rang'=>'numeric'
        ));
        if(!$validator->fails()){
            $company=Company::find(Input::get('company'));
            $company->banks()->attach(Input::has('bank'),array('bank_account'=>Input::get('bank_account'),'rang'=>Input::get('rang')));
            return ProcessResponse::$success;
        }else{
            return ProcessResponse::getError(1000,$validator->messages());
        }
    }

}