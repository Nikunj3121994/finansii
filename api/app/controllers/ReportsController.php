<?php

class ReportsController extends \BaseController
{
    public function getIndex()
    {

    }

    public function getAccounts()
    {
        $columns=array('accounts.account','archive_ledgers.document_desc',
            'archive_ledgers.document_number','archive_ledgers.document_date',
            DB::raw('(case when archive_ledgers.booking_type=1 then archive_ledgers.amount else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then archive_ledgers.amount else 0 end) as asks'),
            'archive_ledgers.amount as total','orders.order_number','orders.order_type');
        if (Input::has('companyCode')) {
            $header=Company::where('company_code','=',Input::get('companyCode'))

                ->select(array('company_name','company_code'))->first();
            $header['title']='Kartica';
            $header['subTitle']='Sub title';
            $accounts = array();
            $accounts['from'] = 0;
            $accounts['to'] = 999999;
            $query=ArchiveLedger::join('accounts',function($join){
                    $join->on('archive_ledgers.account','=','accounts.account');
                })
                ->join('orders',function($join){
                    $join->on('orders.id','=','archive_ledgers.order_id');
                })
                ->select($columns);
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                    return ProcessResponse::processReport($query
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->get(),$header);
                } else {
                    return ProcessResponse::processReport($query
                        ->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->get(),$header);
                }
            } else return ProcessResponse::processReport($query->where('accounts.account_type', '<=', $accounts['to'])
                ->where('archive_ledgers.account', '>=', $accounts['from'])
                ->get(),$header);
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
    public function getMainBook(){
        $columns=array( DB::raw('left(archive_ledgers.account,3) as account') ,'archive_ledgers.document_desc',
            'archive_ledgers.document_number','archive_ledgers.document_date',
            DB::raw('(case when archive_ledgers.booking_type=1 then sum(archive_ledgers.amount) else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then sum(archive_ledgers.amount) else 0 end) as asks'),
            'archive_ledgers.amount as total','orders.order_number','orders.order_type');
        if (Input::has('companyCode')) {
            $header=Company::where('company_code','=',Input::get('companyCode'))

                ->select(array('company_name','company_code'))->first();
            $header['title']='Kartica';
            $header['subTitle']='Sub title';
            $accounts = array();
            $accounts['from'] = 0;
            $accounts['to'] = 999999;
            $query=ArchiveLedger::join('accounts',function($join){
                    $join->on('archive_ledgers.account','=','accounts.account');
                })
                ->join('orders',function($join){
                    $join->on('orders.id','=','archive_ledgers.order_id');
                })
                ->select($columns)
                ->orderBy('orders.order_number', DB::raw('left(archive_ledgers.account,3)'))
                ->groupBy('orders.order_number')
                ->groupBy( DB::raw('left(archive_ledgers.account,3)'));
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                    return ProcessResponse::processReport($query->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->get(),$header);
                } else {
                    return ProcessResponse::processReport($query->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'))
                        ->get(),$header);
                }
            } else return ProcessResponse::processReport($query->where('accounts.account_type', '<=', $accounts['to'])
                ->where('archive_ledgers.account', '>=', $accounts['from'])
                ->get(),$header);
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
    public function getGrossBalanceSynthetics(){
        $columns=array( DB::raw('left(archive_ledgers.account,3) as account'),
            DB::raw('(case when archive_ledgers.booking_type=1 then sum(archive_ledgers.amount) else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then sum(archive_ledgers.amount) else 0 end) as asks')
           );
        $columns2=array('account',
            DB::raw('sum(s1.owes) as owes'),
            DB::raw('sum(s1.asks) as asks'),
            DB::raw('s1.owes - s1.asks as total'));
        $columns3='account, sum(s1.owes) as owes, sum(s1.asks) as asks, sum(s1.owes) - sum(s1.asks) as total';
       
        if (Input::has('companyCode')) {
            $header=Company::where('company_code','=',Input::get('companyCode'))

                ->select(array('company_name','company_code'))->first();
            $header['title']='Kartica';
            $header['subTitle']='Sub title';
            $accounts = array();
            $accounts['from'] = 0;
            $accounts['to'] = 999999;
            $query1=ArchiveLedger::join('accounts',function($join){
                    $join->on('archive_ledgers.account','=','accounts.account');
                })
                ->join('orders',function($join){
                    $join->on('orders.id','=','archive_ledgers.order_id');
                })
                ->select($columns)
                ->orderBy('archive_ledgers.booking_type',DB::raw('left(archive_ledgers.account,3)'))
                ->groupBy('archive_ledgers.booking_type',DB::raw('left(archive_ledgers.account,3)'));
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                   $query1->where('accounts.account_type', '<=', $accounts['to'])
                       ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'));

                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($accounts['to'],
                        $accounts['from'],Input::get('dateTo'),Input::get('dateFrom'))),$header);
                } else {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'));
                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($accounts['to'],
                        $accounts['from'],Input::get('dateFrom'))),$header);
                }
            } else
            {
                $query1->where('accounts.account_type', '<=', $accounts['to'])
                    ->where('archive_ledgers.account', '>=', $accounts['from']);
                return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($accounts['to'],
                    $accounts['from'])),$header);
            }
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
    public function getGrossBalanceAnalytics(){
        $columns=array( DB::raw('archive_ledgers.account as account'),
            DB::raw('(case when archive_ledgers.booking_type=1 then sum(archive_ledgers.amount) else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then sum(archive_ledgers.amount) else 0 end) as asks')
        );
        $columns3='account, sum(s1.owes) as owes, sum(s1.asks) as asks, sum(s1.owes) - sum(s1.asks) as total';

        if (Input::has('companyCode')) {
            $header=Company::where('company_code','=',Input::get('companyCode'))

                ->select(array('company_name','company_code'))->first();
            $header['title']='Kartica';
            $header['subTitle']='Sub title';
            $accounts = array();
            $accounts['from'] = 0;
            $accounts['to'] = 999999;
            $query1=ArchiveLedger::join('accounts',function($join){
                $join->on('archive_ledgers.account','=','accounts.account');
            })
                ->join('orders',function($join){
                    $join->on('orders.id','=','archive_ledgers.order_id');
                })
                ->select($columns)
                ->orderBy('archive_ledgers.booking_type',DB::raw('archive_ledgers.account'))
                ->groupBy('archive_ledgers.booking_type',DB::raw('archive_ledgers.account'));
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'));

                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($accounts['to'],
                        $accounts['from'],Input::get('dateTo'),Input::get('dateFrom'))),$header);
                } else {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'));
                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($accounts['to'],
                        $accounts['from'],Input::get('dateFrom'))),$header);
                }
            } else
            {
                $query1->where('accounts.account_type', '<=', $accounts['to'])
                    ->where('archive_ledgers.account', '>=', $accounts['from']);
                return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($accounts['to'],
                    $accounts['from'])),$header);
            }
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
}