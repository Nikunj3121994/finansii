<?php

class LedgersController extends \BaseController {
    public function pluralToSingular($string){
        $pluralPrefix = substr($string, -3);
        if($pluralPrefix=="ies") return substr_replace($string,"",-3);
        else return substr_replace($string,"",-1);
    }
	/**
	 * Display a listing of the resource.
	 * GET /ledgers
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Input::has('order_id')){
            $array=Ledger::with(array('accounts'=>function($query){
                    $query->with('subAccounts');
                }))->where('order_id','=',Input::get('order_id'))->app()->get();
            $output=array();
            foreach($array as $ledger){

                $subAccount=$ledger['accounts']['sub_accounts'];
                if($subAccount!==NULL)
                {
                    $tableData=DB::select( "SELECT *,".$this->pluralToSingular($subAccount['sub_account_table'])."_name as name ,".
                        $this->pluralToSingular($subAccount['sub_account_table'])."_code as code FROM ".
                        $subAccount['sub_account_table']." where ".
                        $this->pluralToSingular($subAccount['sub_account_table'])."_code = ".$ledger['sub_account']." limit 1");
                    if(!empty($tableData))
                        $ledger['sub-accounts']=$tableData[0] || NULL;
                }
                $ledger['currencies']=Currency::with(array('exchangeRates'=>function($query) use ($ledger){
                        $query->where('exchange_date','<',$ledger->document_date);
                        $query->orderBy('exchange_date','DESC');
                        $query->first();
                    }))->where('id','=',$ledger->currency_code)->first();
                array_push($output,$ledger);

            }
            return ProcessResponse::process($output);
        }else{
            return ProcessResponse::getError(1000,"Order id required");
        }
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ledgers/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ledgers
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make(Input::all(), array(
            "company_code" => "required|numeric",
            "order_id" => "required|numeric",
            "account" => "required|numeric",
            "booking_type" => "required|numeric",
            "amount" => "required|numeric",
            "currency_code"=>"required|numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            if(Ledger::create(Input::all())){
                return ProcessResponse::$success;
            }else{
                return ProcessResponse::getError( 1000,"Error");
            }
        }
	}

	/**
	 * Display the specified resource.
	 * GET /ledgers/{id}
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
	 * GET /ledgers/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /ledgers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(Input::all(), array(
            "company_code" => "numeric",
            "order_id" => "numeric",
            "sub_account" => "numeric",
            "booking_type" => "numeric",
            "amount" => "numeric",
            "currency_code"=>"numeric"
        ));
        if($validator->fails()){
            return ProcessResponse::getError(1000,$validator->messages());
        }else{
            $model=Ledger::find($id);
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
	 * DELETE /ledgers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Ledger::destroy($id);
	}

}