define([], function () {
    var module = angular.module('app.pages.finance.reports', []);

    module.controller('reportsFinanceController', ['$scope', 'reportService', '$compile', '$filter', 'toasterService'
        , function ($scope, reportService, $compile, $filter, toasterService) {
            $scope.reports = [
                {
                    name: 'accounts',
                    label: 'Accounts Report',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'document_desc', label: 'Description',format:'text'},
                        {name: 'document_number', label: "Number",format:'text'},
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
                } ,
                {
                    name: 'main-book',
                    label: 'Main book',
                    fields: [
                        {name: 'order_number', label: "Order number",format:'text'},
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'document_desc', label: 'Description',format:'text'},
                        {name: 'document_number', label: "Number",format:'text'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'account',
                            group: 0,
                            groupType:'number'
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
                },
                {
                    name: 'accounts',
                    label: 'Analytic card',
                    fields: [
                        {name: 'order_number', label: "Order number",format:'text'},
                        {name: 'document_date', label: "Date",format:'text'},
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'document_desc', label: 'Description',format:'text'},
                        {name: 'document_number', label: "Number",format:'text'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'class',
                            group: 0,
                            groupType:'number',
                            fieldPosition:'order_number'
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
                } ,
                {
                    name: 'gross-balance-synthetics',
                    label: 'Gross balance synthetics',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'start_owes', label: 'Start owes'},
                        {name: 'start_asks', label: 'Start Asks'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'},
                        {name:'total_owes',label:'Total owes'},
                        {name:'total_asks',label:'Total asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'account',
                            group: 2,
                            groupType:'number'
                        }
                    ],
                    sums: [
                        {
                            field: 'start_owes'
                        },
                        {
                            field: 'start_asks'
                        },
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field:'total_asks'
                        },
                        {
                            field:'total_owes'
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
                },{
                    name: 'gross-balance-analytics',
                    label: 'Gross balance analytics',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name:'group1',label:"Group 1",type:"group",
                            fields:[
                                {name: 'owes', label: 'Owes'},
                                {name: 'asks', label: 'Asks'}
                            ]
                        },
                        {name:'total',label:'Total'}
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
                            groupType:'number',
                            groupPrefix:'Class'
                        },
                        {
                            field: 'account',
                            name: 'total',
                            group: 6,
                            groupType:'number',
                            groupPrefix:'Total'
                        }
                    ],
                    headerSettings:{
                        levels:2
                    },
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field: 'total'
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
                },{
                    name: 'gross-balance-synthetics',
                    label: 'Finished sheet',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'start_owes', label: 'Start Owes'},
                        {name: 'start_asks', label: 'Start Asks'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'},
                        {name:'total_owes',label:'Total owes'} ,
                        {name:'total_asks',label:'Total asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'group',
                            group: 1,
                            groupType:'number',
                            groupPrefix:'G.'
                        },{
                            field: 'account',
                            name: 'class',
                            group: 2,
                            groupType:'number',
                            groupPrefix:'C.'
                        },
                        {
                            field: 'account',
                            name: 'total',
                            group: 3,
                            groupType:'number',
                            groupPrefix:'Total'
                        }
                    ],
                    sums: [
                        {
                            field: 'start_owes'
                        },
                        {
                            field: 'start_asks'
                        },
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field: 'total_owes'
                        },
                        {
                            field: 'total_asks'
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
                },{
                    name: 'account-specification',
                    label: 'Account specification',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'account_name', label: "Account Name",format:'text'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'},
                        {name:'total',label:'Total'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'total',
                            group: 6,
                            groupType:'number',
                            groupPrefix:'Total'
                        }
                    ],
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field: 'total'
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
                    $scope.header.title=$scope.currentReport.label;
                    $compile($scope.reportEngineDirective)($scope);
                });
            }
        }]);

    return module;

});