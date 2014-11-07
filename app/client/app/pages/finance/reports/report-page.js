define([], function () {
    var module = angular.module('app.pages.finance.reports', []);
    module.run(['navigationService', function(navigationService){
        var state={
            label:'Reports',
            name:'finance.reports',
            parent:'finance.start'
        }
        navigationService.addState(state,state.name,state.parent);
    }]);
    module.controller('reportsFinanceController', ['$scope', 'reportService', '$compile', '$filter', 'toasterService'
        , function ($scope, reportService, $compile, $filter, toasterService) {
            var reportCache={};
            $scope.reports = reportService.getFinanceConfig();

            $scope.reportEngineDirective = '<div dynamic-report report-config="reports[selectedReport]" report-data="data" header="header"></div>';

            $scope.currentReport = $scope.reports[0];
            $scope.selectedReport = 0;

            $scope.getReport = function () {
                if(!_.isUndefined(reportCache[$scope.currentReport.name])){
                    prepareReportData(reportCache[$scope.currentReport.name]);
                    return;
                }
                if (_.isUndefined($scope.filterData.companies)) {
                    toasterService.setWarning('Company is required');
                    return;
                }
                var filteredData=filterData();
                reportService.getReport(filteredData.requestData, $scope.currentReport.name).then(function (data) {
                    var preparedData=reportService.generateGroupedData(data.body,$scope.currentReport);
                    reportCache[$scope.currentReport.name]={
                            body:preparedData,
                            filterConfig:filteredData.filterConfig,
                            header:data.header
                        };

                    prepareReportData(reportCache[$scope.currentReport.name]);
                });
            };

            $scope.printReport=function(){
                $compile($scope.reportEngineDirective)($scope);
            };

            function prepareReportData(data){
                $scope.data = data.body;
                $scope.header = data.header;
                $scope.header['filters'] = data.filterConfig;
                $scope.header.title=$scope.currentReport.label;
            }

            function filterData(){
                var filterData = {};
                filterData.companyCode = $scope.filterData.companies['company_code'];
                var filterConfig = _.clone($scope.currentReport.filtersConfig);
                for (var i=0;i<$scope.currentReport.filters.length;i++) {
                    var key=$scope.currentReport.filters[i];
                    if ($scope.filterData[key] instanceof Date && !isNaN($scope.filterData[key].valueOf())) {
                        filterData[key] = $filter('date')($scope.filterData[key], "yyyy-MM-dd HH:mm:ss");
                        filterConfig[key].value = $filter('date')($scope.filterData[key], "yyyy-MM-dd HH:mm:ss");
                    } else if (!_.isObject($scope.filterData[key])) {
                        filterData[key] = $scope.filterData[key];
                        if (!_.isUndefined(filterConfig[key])) filterConfig[key].value = $scope.filterData[key];
                    }
                }
                return {
                    requestData:filterData,
                    filterConfig:filterConfig
                };
            }
        }]);

    return module;

});