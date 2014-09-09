<?php

class ArchiveCalculationsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /archivecalculations
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /archivecalculations/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /archivecalculations
	 *
	 * @return Response
	 */
	public function store()
	{
        if(Input::has('calculationHeaderId')){
            DB::statement('INSERT INTO archive_calculations select * from calculation_details where calculation_header_id = ?',
                array(Input::get('calculationHeaderId')));
            CalculationDetail::where('calculation_header_id','=',Input::get('calculationHeaderId'))->delete();
            $CalculationHeader=CalculationHeader::find(Input::get('calculationHeaderId'));
            $CalculationHeader->archived=1;
            $CalculationHeader->save();
            return ProcessResponse::$success;
        } else return ProcessResponse::getError(1000,"Calculation header is not presented");
	}

	/**
	 * Display the specified resource.
	 * GET /archivecalculations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /archivecalculations/{id}/edit
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
	 * PUT /archivecalculations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /archivecalculations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}