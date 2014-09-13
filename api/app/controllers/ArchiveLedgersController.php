<?php

class ArchiveLedgersController extends \BaseController {
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
            $array=Ledger::with('currencies')->with(array('accounts'=>function($query){
                    $query->with('subAccounts');
                }))->where('order_id','=',Input::get('order_id'))->get();
            $output=array();
            foreach($array as $ledger){
               // Log::info(var_dump($ledger));
                $subAccount=$ledger['accounts']['sub_accounts'];
                $tableData=DB::select( "SELECT *,".$this->pluralToSingular($subAccount['sub_account_table'])."_name as name ,".
                    $this->pluralToSingular($subAccount['sub_account_table'])."_code as code FROM ".
                    $subAccount['sub_account_table']." where ".
                    $this->pluralToSingular($subAccount['sub_account_table'])."_code = ".$ledger['sub_account']." limit 1");
                $ledger['sub-accounts']=$tableData[0];
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
        if(Input::has('orderId') && Input::has('companyCode')){
            DB::statement('SET foreign_key_checks = 0;');
            DB::statement('INSERT INTO archive_ledgers select * from ledgers where order_id = ? and company_code = ?',
                array(Input::get('orderId'),Input::get('companyCode')));
            DB::statement('SET foreign_key_checks = 1;');
            Ledger::where('order_id','=',Input::get('orderId'))->where('company_code','=',Input::get('companyCode'))->delete();
            $order=Order::find(Input::get('orderId'));
            $order->archived=1;
            $order->save();
            return ProcessResponse::$success;
        } else return ProcessResponse::getError(1000,"Order id or company code are not presented");

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
       return ProcessResponse::$error;

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