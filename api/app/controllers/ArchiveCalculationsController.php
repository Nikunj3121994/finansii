<?php

class ArchiveCalculationsController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter('create', array('on' => 'store') );
    }
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
    public function createLedger($account,$description,$ledgerData,$currentCalculation,$type,$amount,$order){
        $ledger=new ArchiveLedger();
        $ledger->company_code=$currentCalculation->business_units->company_code;
        $ledger->sub_account=$currentCalculation->partner_code;
        if(strlen($account)<6){
            for($j=0;$j<3-strlen($ledgerData->tariff_rate);$j++)
                $account.='0';
            $account.=$ledgerData->tariff_rate;
        }
        $ledger->account=$account;
        $ledger->document_number=$currentCalculation->document_number;
        $ledger->document_desc=$description;
        $ledger->document_date=$currentCalculation->calculation_ddo;
        $ledger->booking_type=$type;
        $currency=Currency::with(array('exchangeRates'=>function($query) use ($currentCalculation){
                $query->where('exchange_date','<',$currentCalculation->calculation_date);
                $query->orderBy('exchange_date','DESC');
                $query->first();
            }))->where('id','=',$ledger->currency_code)->first();
        $ledger->amount=$amount/$currency->exchange_rates->currency_value;
        $ledger->currency_code=$currentCalculation->currency_code;
        $ledger->amount_currency=$amount;
        $order->ledgers()->save($ledger);
    }
    public function store()
    {
        if (Input::has('calculationHeaderId')) {
            ArchiveCalculation::where('calculation_header_id', '=', Input::get('calculationHeaderId'))->delete();
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
                    DB::raw('sum(quantity*margin) as margin'),'tariff_rate')->get();

            $currentCalculation=CalculationHeader::find(Input::get('calculationHeaderId'))->with('businessUnits')->first();
            $order=new Order();
            $order->order_type=663;
            $order->order_number=$currentCalculation->calculation_number;
            $order->order_date=$currentCalculation->calculation_date;
            $order->order_booking=$currentCalculation->calculation_booked;
            $order->company_code=$currentCalculation->business_units->company_code;
            $order->archived=1;
            $order->save();

            function createLedger($account,$description,$ledgerData,$currentCalculation,$type,$amount,$order){
                $ledger=new ArchiveLedger();
                $ledger->company_code=$currentCalculation->business_units->company_code;
                $ledger->sub_account=$currentCalculation->partner_code;
                if(strlen($account)<6){
                    for($j=0;$j<3-strlen($ledgerData->tariff_rate);$j++)
                        $account.='0';
                    $account.=$ledgerData->tariff_rate;
                }
                $ledger->account=$account;
                $ledger->document_number=$currentCalculation->document_number;
                $ledger->document_desc=$description;
                $ledger->document_date=$currentCalculation->calculation_ddo;
                $ledger->booking_type=$type;
                $currency=Currency::with(array('exchangeRates'=>function($query) use ($currentCalculation){
                        $query->where('exchange_date','<',$currentCalculation->calculation_date);
                        $query->orderBy('exchange_date','DESC');
                        $query->first();
                    }))->where('id','=',1)->first();
                $ledger->amount=$amount/$currency->exchange_rates->currency_value;
                $ledger->currency_code=$currentCalculation->currency_code;
                $ledger->amount_currency=$amount;
                $order->ledgers()->save($ledger);
            }
            for($i=0;$i<sizeof($ledgerData);$i++){
                $currentData=$ledgerData[$i];
                createLedger('220000','Набавна со ддв',$currentData,$currentCalculation,1,$currentData->price_input,$order);
                createLedger('161000','Влезно ддв',$currentData,$currentCalculation,1,$currentData->tax_input,$order);
                createLedger('664','Вкупно ддв',$currentData,$currentCalculation,0,$currentData->tax_output,$order);
                createLedger('669000','Рабат',$currentData,$currentCalculation,0,$currentData->rabat,$order);
                createLedger('663','Вредност на стоки',$currentData,$currentCalculation,1,$currentData->price_output,$order);
                createLedger('669000','Маржа',$currentData,$currentCalculation,0,$currentData->margin,$order);
            }



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