define([], function () {
    var module = angular.module('app.pages.retail.reports', []);
    module.run(['navigationService', function(navigationService){
        var state={
            label:'Reports',
            name:'retail.reports',
            parent:'retail.start'
        }
        navigationService.addState(state,state.name,state.parent);
    }]);
    module.controller('reportsRetailController', ['$scope', 'reportService', '$compile', '$filter', 'toasterService'
        , function ($scope, reportService, $compile, $filter, toasterService) {
            $scope.reports = [
                {
                    name: 'accounts',
                    label: 'Accounts Report',
                    fields: [
                        {name: 'account', label: "Account"},
                        {name: 'document_desc', label: 'Description'},
                        {name: 'document_number', label: "Number"},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'account',
                            group: 3,
                            groupType:'number'
                        },
                        {
                            field: 'account',
                            name: 'class',
                            group: 5,
                            groupType:'number'
                        },
                        {
                            field: 'order_number',
                            name: 'order',
                            group: 0,
                            type:'header',
                            groupType:'text',
                            fieldPosition:'account'
                        }
                    ],
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                }
            ];
            $scope.reportEngineDirective = '<div dynamic-report report-config="reports[selectedReport]" report-data="data" header="header"></div>';
            $scope.currentReport = $scope.reports[0];
            $scope.selectedReport = 0;
            $scope.getReport = function () {
                if (_.isUndefined($scope.filterData.companies)) {
                    toasterService.setWarning('Company is required');
                    return;
                }
                $scope.filterData.companyCode = $scope.filterData.companies['company_code'];
                var filterData = {};
                var filterConfig = _.clone($scope.currentReport.filtersConfig);
                for (key in $scope.filterData) {

                    if ($scope.filterData[key] instanceof Date && !isNaN($scope.filterData[key].valueOf())) {
                        filterData[key] = $filter('date')($scope.filterData[key], "yyyy-MM-dd HH:mm:ss");
                        filterConfig[key].value = $filter('date')($scope.filterData[key], "yyyy-MM-dd HH:mm:ss");
                    } else if (!_.isObject($scope.filterData[key])) {
                        filterData[key] = $scope.filterData[key];
                        if (!_.isUndefined(filterConfig[key])) filterConfig[key].value = $scope.filterData[key];
                    }
                }
                reportService.getReport(filterData, $scope.currentReport.name).then(function (data) {
                    $scope.data = data.body;
                    $scope.header = data.header;
                    $scope.header['filters'] = filterConfig;
                    $compile($scope.reportEngineDirective)($scope);
                });
            }
        }]);

    return module;

});