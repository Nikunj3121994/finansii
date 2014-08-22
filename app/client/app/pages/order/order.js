define([], function() {
    var module = angular.module('app.pages.order', []);

    module.controller('orderController', function ($scope) {
        $scope.orderParameters = {};
        $scope.smallGridOptions = {
            permissions: {
                filterColumns: false,
                addResource: false,
                editResource: false,
                deleteResource: false
            },
            formName: "small-grid"
        };


        $scope.$watch('ordersSelectedId', function () {
            console.log($scope.ordersSelectedId);
            if (_.isUndefined($scope.ordersData)) return;
            var row = null;
            for (var i = 0; i < $scope.ordersData.rows.length; i++) {
                if ($scope.ordersData.rows[i].id == $scope.ordersSelectedId) {
                    row = $scope.ordersData.rows[i];
                    break;
                }
            }
            if (_.isNull(row)) return;
            $scope.orderParameters.organization = "001";
            $scope.orderParameters.orderType = row.cols[0].val;
            $scope.orderParameters.orderNumber = row.cols[1].val;
            $scope.orderParameters.orderDate = row.cols[2].val;
        });

        $scope.summaryCalculations = [
            {
                label: 'Должи :',
                mathFunction: {
                    funcArgs: {
                        column: 5
                    },
                    formula: "sumColumn"
                }
            },
            {
                label: 'Побарува :',
                mathFunction: {
                    funcArgs: {
                        column: 6
                    },
                    formula: "sumColumn"
                }
            },
            {
                label: 'Вкупно :',
                mathFunction: {
                    formula: "diff",
                    funcArgs: {
                        val1: {
                            formula: "sumColumn",
                            funcArgs: {
                                column: 5
                            }
                        },
                        val2: {
                            formula: "sumColumn",
                            funcArgs: {
                                column: 6
                            }
                        }
                    }
                }
            }
        ]
    });

    return module;
});