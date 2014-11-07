define([], function () {
    var module = angular.module('app.pages.retail', []);
    module.run(['navigationService', function(navigationService){
        var state={
            label:'Retail',
            name:'retail.start',
            parent:'dashboard'
        }
        navigationService.addState(state,state.name,state.parent);
    }]);
    module.config(['$stateProvider', function($stateProvider){
       $stateProvider.state('retail', {
           url: '/retail',
           abstract: true,
           views: {
               headerView: {
                   template: '<div data-custom-header></div>'
               },
               contentView: {
                   templateUrl: 'app/pages/retail/retail.html'
               }
           }
       }).state('retail.start', {
           url: '',
           templateUrl: 'app/pages/retail/retail.html'
       }).state('retail.resources',{
           url:'/resources',
           template:'<div resources-calculations-page></div>'
       }).state('retail.resources.resource',{
           url:'/:resource',
           template:'<custom-grid grid-resource="{{resource}}"></custom-grid>',

           controller:['$scope', '$stateParams', function($scope,$stateParams){
               $scope.resource=$stateParams.resource;
           }]
       }).state('retail.calculationHeader',{
           url:'/calculations',
           templateUrl:'app/pages/retail/calculations/calculations.html'
       }).state('retail.calculationHeader.calculations',{
           url:'/:calculationHeaderId',
           template:'<custom-grid grid-resource="calculation-details" grid-params="params"></custom-grid>',

           controller:['$scope', '$stateParams', function($scope,$stateParams){
               $scope.params={
                   calculation_header_id:$stateParams.calculationHeaderId
               };
           }]
       }).state('retail.reports',{
           url:'/reports',
           templateUrl:'app/pages/retail/reports/reports.html'
       });
    }]);
    return module;
});