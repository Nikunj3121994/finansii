<?php

class CalculationHeadersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /calculationheaders
	 *
	 * @return Response
	 */
	public function index()
	{
        return ProcessResponse::process(CalculationHeader::with('businessUnits')->with('partners')->with('calculationTypes')->with('currencies')->get());
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /calculationheaders/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /calculationheaders
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "business_unit_id" => "required|numeric",
            "calculation_number" => "required|numeric",
            "document_number" => "required|numeric",
            "partner_code" => "required|numeric",
            "calculation_date" => "required",
            "calculation_ddo" => "required",
            "calculation_booked" => "required",
            "currency_code" => "required|numeric",
            "currency_value" => "required|numeric",
            "calculation_type_code" => "required|numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(CalculationHeader::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /calculationheaders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(CalculationHeader::find($id)->with('businessUnits')->with('partners')->with('currencies')->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /calculationheaders/{id}/edit
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
	 * PUT /calculationheaders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "business_unit_id" => "numeric",
            "calculation_number" => "numeric",
            "document_number" => "numeric",
            "partner_code" => "numeric",
            "currency_code" => "numeric",
            "currency_value" => "numeric",
            "calculation_type_code" => "numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=CalculationHeader::find($id);
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
	 * DELETE /calculationheaders/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        CalculationHeader::destroy($id);
        return ProcessResponse::$success;
	}

}