<?php

class CalculationDetailsController extends \BaseController {

    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
	/**
	 * Display a listing of the resource.
	 * GET /calculationdetails
	 *
	 * @return Response
	 */
	public function index()
	{
		If(Input::has('calculation_header_id')){
            return ProcessResponse::process(CalculationDetail::with('articles')
                ->where('calculation_header_id','=',Input::get('calculation_header_id'))->app()->get());

        } else ProcessResponse::getError(1000,"Calculation header is required");
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /calculationdetails/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /calculationdetails
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "calculation_header_id" => "required|numeric",
            "article_id" => "required|numeric",
            "quantity" => "required|numeric",
            "rabat" => "required|numeric",
            "price_input1" => "required|numeric",
            "tariff_rate_input"=>"required|numeric",
            "tax_input" => "required|numeric",
            "tax_output" => "required|numeric",
            "price_input2" => "required|numeric",
            "margin"=>"required|numeric",
            "price_output1" => "required|numeric",
            "price_output2" => "required|numeric",
            "tariff_code" => "required|numeric",
            "debit_credit"=>"required|numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(CalculationDetail::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /calculationdetails/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return ProcessResponse::process(CalculationDetail::find($id)->with('articles')->app()->first());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /calculationdetails/{id}/edit
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
	 * PUT /calculationdetails/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "calculation_header_id" => "numeric",
            "article_id" => "numeric",
            "quantity" => "numeric",
            "rabat" => "numeric",
            "price_input1" => "numeric",
            "tariff_rate_input"=>"numeric",
            "tax_input" => "numeric",
            "tax_output" => "numeric",
            "price_output2" => "numeric",
            "margin"=>"numeric",
            "price_output3" => "numeric",
            "price_output4" => "numeric",
            "tariff_code" => "numeric",
            "debit_credit"=>"numeric",
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=CalculationDetail::find($id);
            if($model->fill(Input::all())){
                $model->save();
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /calculationdetails/{id}
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