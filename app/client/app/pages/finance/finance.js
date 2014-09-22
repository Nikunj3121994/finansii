define([], function () {
    var module = angular.module('app.pages.finance', []);
    module.config(function($stateProvider){
        $stateProvider.state('finance', {
            url: '/finance',
            abstract: true,
            views: {
                headerView: {
                    template: '<div data-custom-header></div>'
                },
                contentView: {
                    templateUrl: 'app/pages/finance/finance.html'
                }
            }
        }).state('finance.start', {
            url: '',
            templateUrl: 'app/pages/finance/finance.html'
        }).state('finance.resources',{
            url:'/resources',
            template:'<div resources-page></div>'
        }).state('finance.resources.resource',{
            url:'/:resource',
            template:'<custom-grid grid-resource="{{resource}}"></custom-grid>',

            controller:function($scope,$stateParams){
                $scope.resource=$stateParams.resource;
            }
        }).state('finance.orders',{
            url:'/orders',
            templateUrl:'app/pages/finance/orders/orders.html'
        }).state('finance.orders.ledgers',{
            url:'/:companyCode/:orderId',
            template:'<custom-grid grid-resource="ledgers" grid-params="params"></custom-grid>',

            controller:function($scope,$stateParams){
                $scope.params={
                    order_id:$stateParams.orderId,
                    company_code:$stateParams.companyCode
                };
            }
        }).state('finance.reports',{
            url:'/reports',
            templateUrl:'app/pages/finance/reports/reports.html'
        })
    });
    module.run(function(navigationService){
        var state={
            label:'Finance',
            name:'finance.start',
            parent:'dashboard'
        }
        navigationService.addState(state,state.name,state.parent);
    });
    return module;
});