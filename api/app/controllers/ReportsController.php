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
                ->select($columns)
                ->app();
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
        $user=Auth::user();
        $columns=array( DB::raw('left(archive_ledgers.account,3) as account') ,'archive_ledgers.document_desc',
            'archive_ledgers.document_number','archive_ledgers.document_date',
            DB::raw('(case when archive_ledgers.booking_type=1 then sum(archive_ledgers.amount) else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then sum(archive_ledgers.amount) else 0 end) as asks'),
            'archive_ledgers.amount as total','orders.order_number','orders.order_type');
        $columns3='order_number, document_desc, document_date, document_number, account, sum(s1.owes) as owes, sum(s1.asks) as asks, sum(s1.owes) - sum(s1.asks) as total';
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
                ->orderBy('orders.order_number','archive_ledgers.booking_type', DB::raw('left(archive_ledgers.account,3)'))
                ->groupBy('orders.order_number','archive_ledgers.booking_type',DB::raw('left(archive_ledgers.account,3)'))
                ->app();
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                   $query->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'));
                    Log::info('select '.$columns3.' from ('.$query->toSql().') s1 group by s1.account, s1.order_number');
                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query->toSql().') s1 group by s1.account, s1.order_number',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateTo'),Input::get('dateFrom'))),$header);
                } else {
                   $query->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'));

                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query->toSql().') s1 group by s1.account, s1.order_number',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateFrom'))),$header);
                }
            } else {
                $query->where('accounts.account_type', '<=', $accounts['to'])
                ->where('archive_ledgers.account', '>=', $accounts['from']);
                return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query->toSql().') s1 group by s1.account, s1.order_number',array($user->application,$accounts['to'],
                    $accounts['from'])),$header);
            }
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
    public function getGrossBalanceSynthetics(){
        $user=Auth::user();
        $columns=array( DB::raw('left(archive_ledgers.account,3) as account'),
            DB::raw('(case when archive_ledgers.booking_type=1 then sum(archive_ledgers.amount) else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then sum(archive_ledgers.amount) else 0 end) as asks'),
            DB::raw('(case when (archive_ledgers.booking_type=1 and date_format(orders.order_date,"%Y-%m-%d")=makedate(year(orders.order_date),1)) then sum(archive_ledgers.amount) else 0 end) as start_owes'),
            DB::raw('(case when (archive_ledgers.booking_type!=1 and date_format(orders.order_date,"%Y-%m-%d")=makedate(year(orders.order_date),1)) then sum(archive_ledgers.amount) else 0 end) as start_asks'),
            DB::raw('(case when date_format(orders.order_date,"%Y-%m-%d")=makedate(year(orders.order_date),1) then 1 else 0 end) as grouping')
           );

        $columns3='account,ROUND(sum(start_owes),2) as start_owes, ROUND(sum(start_asks),2)
            as start_asks, ROUND(sum(s1.owes),2) as owes, ROUND(sum(s1.asks),2) as asks,
            ROUND(sum(s1.start_owes) - sum(s1.owes),2) as total_owes,
            ROUND( sum(s1.start_asks) - sum(s1.asks),2) as total_asks';
       
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
                ->orderBy('archive_ledgers.booking_type','grouping',DB::raw('left(archive_ledgers.account,3)'))
                ->groupBy('archive_ledgers.booking_type','grouping',DB::raw('left(archive_ledgers.account,3)'))
                ->app();
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                   $query1->where('accounts.account_type', '<=', $accounts['to'])
                       ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'));

                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateTo'),Input::get('dateFrom'))),$header);
                } else {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'));
                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateFrom'))),$header);
                }
            } else
            {
                $query1->where('accounts.account_type', '<=', $accounts['to'])
                    ->where('archive_ledgers.account', '>=', $accounts['from']);
                return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                    $accounts['from'])),$header);
            }
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
    public function getGrossBalanceAnalytics(){
        $user=Auth::user();
        $columns=array( DB::raw('archive_ledgers.account as account'),
            DB::raw('(case when (archive_ledgers.booking_type=1 and date_format(orders.order_date,"%Y-%m-%d")!=makedate(year(orders.order_date),1)) then sum(archive_ledgers.amount) else 0 end) as owes'),
            DB::raw('(case when (archive_ledgers.booking_type!=1 and date_format(orders.order_date,"%Y-%m-%d")!=makedate(year(orders.order_date),1)) then sum(archive_ledgers.amount) else 0 end) as asks'),
            DB::raw('(case when (archive_ledgers.booking_type=1 and date_format(orders.order_date,"%Y-%m-%d")=makedate(year(orders.order_date),1)) then sum(archive_ledgers.amount) else 0 end) as start_owes'),
            DB::raw('(case when (archive_ledgers.booking_type!=1 and date_format(orders.order_date,"%Y-%m-%d")=makedate(year(orders.order_date),1)) then sum(archive_ledgers.amount) else 0 end) as start_asks'),
            DB::raw('(case when date_format(orders.order_date,"%Y-%m-%d")=makedate(year(orders.order_date),1) then 1 else 0 end) as grouping')
        );
        $columns3='account, sum(s1.start_owes) as start_owes, sum(s1.start_asks) as start_asks, sum(s1.owes) as owes, sum(s1.asks) as asks, sum(s1.owes) - sum(s1.asks) as total';

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
                ->orderBy('archive_ledgers.booking_type','grouping',DB::raw('archive_ledgers.account'))
                ->groupBy('archive_ledgers.booking_type','grouping',DB::raw('archive_ledgers.account'))
                ->app();
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'));

                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateTo'),Input::get('dateFrom'))),$header);
                } else {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'));
                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateFrom'))),$header);
                }
            } else
            {
                $query1->where('accounts.account_type', '<=', $accounts['to'])
                    ->where('archive_ledgers.account', '>=', $accounts['from']);
                return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                    $accounts['from'])),$header);
            }
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }
    public function getAccountSpecification(){
        $user=Auth::user();
        $columns=array( DB::raw('archive_ledgers.account as account'),'accounts.account_name',
            DB::raw('(case when archive_ledgers.booking_type=1 then sum(archive_ledgers.amount) else 0 end) as owes'),
            DB::raw('(case when archive_ledgers.booking_type!=1 then sum(archive_ledgers.amount) else 0 end) as asks')
        );
        $columns3='account, account_name, sum(s1.owes) as owes, sum(s1.asks) as asks, sum(s1.owes) - sum(s1.asks) as total';

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
                ->groupBy('archive_ledgers.booking_type',DB::raw('archive_ledgers.account'))
                ->app();
            if (Input::has('accountFrom')) $accounts['from'] = Input::get('accountFrom');
            if (Input::has('accountTo')) $accounts['to'] = Input::get('accountTo');
            if (Input::has('dateFrom')) {
                if (Input::has('dateTo')) {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '<=', Input::get('dateTo'))
                        ->where('document_date', '>=', Input::get('dateFrom'));

                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateTo'),Input::get('dateFrom'))),$header);
                } else {
                    $query1->where('accounts.account_type', '<=', $accounts['to'])
                        ->where('archive_ledgers.account', '>=', $accounts['from'])
                        ->where('document_date', '>=', Input::get('dateFrom'));
                    return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                        $accounts['from'],Input::get('dateFrom'))),$header);
                }
            } else
            {
                $query1->where('accounts.account_type', '<=', $accounts['to'])
                    ->where('archive_ledgers.account', '>=', $accounts['from']);
                return ProcessResponse::processReport(DB::select('select '.$columns3.' from ('.$query1->toSql().') s1 group by s1.account',array($user->application,$accounts['to'],
                    $accounts['from'])),$header);
            }
        } else {
            return ProcessResponse::getError('1000', 'Company is required');
        }
    }

}