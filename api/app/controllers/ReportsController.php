<?php

class ReportsController extends \BaseController
{
    public function getIndex()
    {

    }

    public function getAccounts()
    {
        $columns=array('account','document_desc','document_number','document_date',
            DB::raw('(case when booking_type=1 then amount else 0 end) as owe'),
            DB::raw('(case when booking_type!=1 then amount else 0 end) as asks'));
        if (Input::has('companyCode')) {
            $accounts = array();
            $accounts['from'] = 0;
            $accounts['to'] = 999999;
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                    return ProcessResponse::process(ArchiveLedger::where('account', '<=', $accounts['to'])
                        ->where('account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->get());
                } else {
                    return ProcessResponse::process(ArchiveLedger::where('account', '<=', $accounts['to'])
                        ->where('account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->select($columns)
                        ->get());
                }
            } else return ProcessResponse::process(ArchiveLedger::where('account', '<=', $accounts['to'])
                ->where('account', '>=', $accounts['from'])
                ->select($columns)
                ->get());
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
}