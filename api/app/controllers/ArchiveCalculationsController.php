<?php

class ArchiveCalculationsController extends \BaseController
{

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
        if (Input::has('calculationHeaderId')) {
            DB::statement('INSERT INTO archive_calculations select * from calculation_details where calculation_header_id = ?',
                array(Input::get('calculationHeaderId')));
            $ledgerData=ArchiveCalculation::join('calculation_headers', function ($calcHeader) {
                    $calcHeader->on('archive_calculations.calculation_header_id', '=', 'calculation_headers.id');
                })
                ->join('articles', function ($article) {
                    $article->on('archive_calculations.article_id', '=', 'articles.id');
                })
                ->join('tariffs', function ($tariff) {
                    $tariff->on('articles.tariff_code', '=', 'tariffs.tariff_code');
                })
                ->where('calculation_header_id', '=', Input::get('calculationHeaderId'))
                ->orderBy('archive_calculations.calculation_header_id', 'articles.tariff_code')
                ->groupBy('archive_calculations.calculation_header_id', 'articles.tariff_code')
                ->select(DB::raw('sum(quantity*price_input2) as price_input'), DB::raw('sum(quantity*tax_input) as tax_input'),
                    DB::raw('sum(quantity*tax_output) as tax_output'), DB::raw('sum(quantity*price_output2) as price_output'),
                    DB::raw('(case when rabat>0 then sum(quantity*(price_input1*(rabat/100))) else 0 end) as rabat'),
                    DB::raw('sum(quantity*margin) as margin'))->get();

            $currentCalculation=CalculationHeader::find(Input::get('calculationHeaderId'));
            $order=new Order();
            $order->order_type=669;
            $order->order_number=$currentCalculation->calculation_number;
            $order->order_date=$currentCalculation->calculation_date;
            $order->order_booking=$currentCalculation->calculation_booked;
            $order->company_code=$currentCalculation->partner_code;
            $order->save();


            CalculationDetail::where('calculation_header_id', '=', Input::get('calculationHeaderId'))->delete();
            $CalculationHeader = CalculationHeader::find(Input::get('calculationHeaderId'));
            $CalculationHeader->archived = 1;
            $CalculationHeader->save();
            return ProcessResponse::$success;
        } else return ProcessResponse::getError(1000, "Calculation header is not presented");
    }

    /**
     * Display the specified resource.
     * GET /archivecalculations/{id}
     *
     * @param  int $id
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
     * @param  int $id
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
     * @param  int $id
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
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}