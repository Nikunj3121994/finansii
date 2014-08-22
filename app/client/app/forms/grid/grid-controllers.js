define([], function() {
    /**
     * @ngdoc overview
     * @name grid.module:controllers
     * @module grid
     * @description
     *  module that wraps all controlers needed for custum grid directive
     */
    var module = angular.module("app.forms.grid.controllers", []);


    /**
     * @ngdoc controller
     * @name grid.controller:gridController
     * @module grid
     * @requires ng.$scope
     * @requires ng.$http
     * @requires ng.$filter
     * @description used for handling the resuouce that fills the grid, pagination, selection of rows
     */
    module.controller("gridController", function ($scope, $http, $filter, jsonGridDataService) {
        $scope.data = {};
        $scope.dataChangeTag = false;
        $scope.dataReady = false;
        $scope.selectedItems = {};
        $scope.protoModels = {};

        if (_.isUndefined($scope.gridOptions)) $scope.gridOptions = {};

        if (!$scope.selectedRow) {
            $scope.selectedRow = -1;
        }

        $scope.gridOrder = {
            reverse: false,
            orderColumn: -1
        };

        $scope.showAllColumns = function () {
            $.each($scope.data.colsSettings, function (i, v) {
                v.visible = true;
            });
        };

        $scope.deleteResources = function () {
            for (var id in $scope.selectedItems) {
                if ($scope.selectedItems[id]) {
                    for (var i = 0; i < $scope.data.rows.length; i++) {
                        if ($scope.data.rows[i].id == id) {
                            $scope.data.rows.splice(i, 1);
                            break;
                        }
                    }
                }
            }
            //TODO delete na server na selektiranite id-a

            $scope.dataChangeTag = !$scope.dataChangeTag;
        };


        //Za da se smenet broj na strani
        //TODO posle promena na filtered data da se desavat ova
        var wcArray = [
            'searchField',
            'pagination.currentPage',
            'pagination.pageSize',
            'gridOrder.orderColumn',
            'gridOrder.reverse',
            'dataChangeTag'
        ].toString();
        var wcArray = '[' + wcArray + ']';
        $scope.$watchCollection(wcArray, function () {
                if (!$scope.data.rows) {
                    $scope.filteredData = null;
                    return;
                }
                var temp = $scope.data.rows;

                temp = $filter('filter')(temp, $scope.searchField);
                temp = $filter('orderByColumn')(temp, $scope.gridOrder.orderColumn, $scope.gridOrder.reverse);

                //Pagination is calculated before data is filtered by current page
                $scope.pagination.totalItems = temp.length;

                temp = $filter('currentPageFilter')(temp, $scope.pagination.currentPage, $scope.pagination.pageSize);
                $scope.filteredData = temp;

            }
        );
        $scope.$watch("gridDataUrl", function () {
            //TODO ke se zemat ime na funkcija i servis od scope
            jsonGridDataService["getData"]($scope.gridDataUrl).then(function (data) {
                $scope.data = data;
                $scope.dataChangeTag = !$scope.dataChangeTag;

            });
        });
    })


    /**
     * @ngdoc controller
     * @name grid.controller:formController
     * @module grid
     * @description controller that handles action made on the form, binding the data from the form and saving data
     */

    module.controller("formController", function controller($scope) {
        var formName = $scope.gridOptions.formName;
        $scope.setFormData = function () {
            $scope.formData = {};
            var row = getRowById();
            if (row !== false) {
                $.each($scope.data.colsSettings, function (i, v) {
                    $scope.formData[v.submitName] = row.cols[i].val;
                });
            }
        };
        $scope.isFormValid = function () {
            return !$scope[formName].$valid;
        };

        $scope.submitForm = function () {
            if ($scope.selectedRowId > -1) {
                updateRow();
            } else {
                addRow();
            }
            $scope.cancelForm();
        };
        $scope.cancelForm = function () {
            $scope.formData = null;
            $scope[formName].$setPristine();
        };
        function updateRow() {
            if ($scope[formName]) {
                var rowId = getRowIndexById();
                $.each($scope.data.colsSettings, function (i, v) {
                    $scope.data.rows[rowId].cols[i].val = $scope.formData[v.submitName];
                });
                //TODO http post do server
            } else {
                console.log('form is not valid');
            }
        }

        function addRow() {
            var row = {};
            row.id = Math.random() * (10000 - 100) + 100;
            row.cols = [];
            $.each($scope.data.colsSettings, function (i, v) {
                row.cols.push({
                        val: $scope.formData[v.submitName]
                    }
                );
            });
            $scope.data.rows.push(row);
            $scope.dataChangeTag = !$scope.dataChangeTag;
        }


        $scope.editDataRow = function (id, index) {
            $scope.selectedRowId = id;
            $scope.setFormData();
            $scope.formLabel = "Измени";
        };
        $scope.addNewResource = function () {
            $scope.selectedRowId = -1;
            $scope.setFormData();
            $scope.formLabel = "Додади";
        };


        function getRowById() {
            for (var i = 0; i < $scope.data.rows.length; i++) {
                if ($scope.data.rows[i].id == $scope.selectedRowId) {
                    return $scope.data.rows[i];
                }
            }
            return false;
        }

        function getRowIndexById() {
            for (var i = 0; i < $scope.data.rows.length; i++) {
                if ($scope.data.rows[i].id == $scope.selectedRowId) {
                    return i;
                }
            }
            return -1;
        }
    });

    return module;
});

