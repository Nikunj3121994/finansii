define([], function() {
    var module = angular.module('app.pages.reports', []);

    module.controller('reportsController', ['$scope','reportService', function ($scope,reportService) {
        $scope.reports = [{
            name: 'accounts',
            label:'Accounts Report',
            fields: [
                'account',
                'document_desc',
                'document_number',
                'owes',
                'asks'
            ],
            filters:['orderFrom','orderTo','dateFrom','dateTo']
        }];
        $scope.currentReport=$scope.reports[0];
        $scope.selectedReport=0;
        $scope.getReport=function(){
            $scope.filterData.companyCode=$scope.filterData.companies['company_code'];
            var filterData={};
            for(key in $scope.filterData){
                if(!_.isObject($scope.filterData[key])){
                    filterData[key]=$scope.filterData[key];
                }
            }
            reportService.getReport(filterData,$scope.currentReport.name).then(function(data){
                console.log(data);
            });
        }
    }]);

    return module;

});