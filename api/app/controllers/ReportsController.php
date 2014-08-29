<?php

class ReportsController extends \BaseController
{
    public function getIndex()
    {

    }

    public function getAccounts()
    {
        $columns=array('accounts.account_type as account','archive_ledgers.document_desc',
            'archive_ledgers.document_number','archive_ledgers.document_date',
            DB::raw('(case when archive_ledgers.booking_type=1 then archive_ledgers.amount else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then archive_ledgers.amount else 0 end) as asks'));
        if (Input::has('companyCode')) {
            $accounts = array();
            $accounts['from'] = 0;
            $accounts['to'] = 999999;
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                    return ProcessResponse::process(ArchiveLedger::where('accounts.account_type', '<=', $accounts['to'])
                        ->join('accounts',function($join){
                            $join->on('archive_ledgers.account','=','accounts.id');
                        })
                        ->where('account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->get());
                } else {
                    return ProcessResponse::process(ArchiveLedger::where('accounts.account_type', '<=', $accounts['to'])
                        ->where('account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->join('accounts',function($join){
                            $join->on('archive_ledgers.account','=','accounts.id');
                        })
                        ->select($columns)
                        ->get());
                }
            } else return ProcessResponse::process(ArchiveLedger::where('accounts.account_type', '<=', $accounts['to'])
                ->where('account', '>=', $accounts['from'])
                ->join('accounts',function($join){
                    $join->on('archive_ledgers.account','=','accounts.id');
                })
                ->select($columns)
                ->get());
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
}