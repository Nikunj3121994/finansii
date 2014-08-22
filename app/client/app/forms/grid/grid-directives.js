define([
    'forms/inputs/custom-text-input',
    'forms/inputs/custom-date',
    'forms/inputs/custom-spinner'
], function () {
    /**
     * @ngdoc overview
     * @name grid.module:directives
     * @module grid
     * @description Module that wraps all directives the are used in the grid
     * @requires app.forms.inputs.customtext
     */
    var module = angular.module("app.forms.grid.directives", [
        "app.forms.inputs.customText",
        "app.forms.inputs.customDate",
        "app.forms.inputs.customSpinner",
        "ui.mask"
    ]);


    /**
     * @ngdoc directive
     * @name grid.directive:custom-grid
     * @module grid
     * @description Directive for creating custom dynamic grid

     */
    module.directive("customGrid", function () {
        var defaultOptions = {
            permissions: {
                search: true,
                select: 'multiple',
                filterColumns: true,
                addResource: true,
                editResource: true,
                deleteResource: true
            },
            formName: "default-name",
            pageSize: 6
        };
        var isolatedScope = {
            data: "=?gridData",
            gridName: "=",
            gridOptions: "=?",
            gridResource:"@",
            gridDataUrl: "@" // ova ne trebit ovde - vo servis
        };


        // Taken from lodash.js source ln#6108
        var defaultsDeep = _.partialRight(_.merge, function deep(value, other) {
            return _.merge(value, other, deep);
        });

        function link($scope, element, attrs) {
//                _.defaults($scope.gridOptions, defaultOptions);
//                _.defaults($scope.gridOptions.permissions, defaultOptions.permissions);
            defaultsDeep($scope.gridOptions, defaultOptions);

            //Must be in link so $scope.gridOptions is defined
            $scope.pagination = {
                pageSize: $scope.gridOptions.pageSize,
                currentPage: 1
            };
        }

        return {
            restrict: 'E',
            controller: 'gridController',
            templateUrl: "app/forms/grid/views/grid.html",
            scope: isolatedScope,
            link: link
        }
    });
    /**
     * @ngdoc directive
     * @module grid
     * @description Directive for creating dynamic rows inside the table.
     * @name grid.directive:grid-row
     */
    module.directive('gridRow', function () {
        function link($scope, element) {
            //TODO ova dali morat da e direktiva
            $scope.rowIndex = $scope.$index;
            element.click(function () {
                $scope.$parent.selectedRow = $scope.$index;
                $scope.$parent.selectedRowData = $scope.filteredData[$scope.$index];

            })

        }

        return {
            restrict: 'EA',
            link: link,
            templateUrl: 'app/forms/grid/views/grid-row.html'
        }
    });


    /**
     * @ngdoc directive
     * @module grid
     * @description Directive for displaying the header of the grid, with options for orderings columns
     * @name grid.directive:grid-head
     */
    module.directive('gridHead', function () {
        function link($scope) {
            /**
             * function for ordering column based on the index of the column
             * @param {number} index - index of the column
             */
            $scope.orderColumn = function (column) {
                if (column == $scope.gridOrder.orderColumn) {
                    $scope.gridOrder.reverse = !$scope.gridOrder.reverse;
                } else {
                    $scope.gridOrder.orderColumn = column;
                }
            };
            $scope.selectAllRows = function () {
                $.each($scope.data.rows, function (i, v) {
                    $scope.selectedItems[v.id] = $scope.protoModels.selectAllToggle;
                })
            }
        }

        return {
            restrict: 'EA',
            templateUrl: 'app/forms/grid/views/grid-head.html',
            link: link
        }
    });


    module.directive('gridActions', function () {
        return {
            restrict: 'E',
            templateUrl: 'app/forms/grid/views/grid-actions.html'
        }
    });

    /**
     * @ngdoc directive
     * @module grid
     * @description directive fo creating custum dynamic form, filed with various types of inputs (text, date, auto complete)
     * @name grid.directive:custom-form
     */
    module.directive('customForm', function ($compile) {
        function link(scope, element, attrs) {
            var createContextGroup = function (header) {
                var contextGroup = $('<div class="panel panel-info">');
                contextGroup.append($('<div class="panel-heading">'));
                contextGroup.append($('<div class="panel-body">'));

                contextGroup.find('.panel-heading').text(header);
                return contextGroup;
            };

            //TODO da vidime dali morat watch
            scope.$watch('config', function () {
                if (!(typeof scope.config === "undefined")) {
                    if (attrs.$attr.formId) {
                        scope.setFormData(attrs.formId);
                    }
                    var formGroups = [];
                    var inputGroups = [];

                    var inputCont = element.find('.js-input-container');
                    for (var i = 0; i < scope.config.order.length; i++) {
                        var inputGroup = $('<div class="col-md-12"></div>');
                        var tplData = scope.config[scope.config.order[i]];
                        var tempInput;
                        if (tplData)
                            if (tplData.type == "text") {
                                tempInput = $('<input data-custom-input>');
                            } else if (tplData.type == "date") {
                                tempInput = $('<input data-custom-date>');
                            } else if (tplData.type == "number") {
                                tempInput = $('<input data-custom-spinner>');
                            } else if (tplData.type == "autocomplete") {
                                tempInput = $('<input data-custom-auto-complete>');
                                tempInput.attr('data-resource',tplData.resource);
                                tempInput.attr('data-field',tplData.field);
                            }
                            tempInput.attr('input-name', tplData.name);
                            tempInput.attr('input-label', tplData.label);
                            if (tplData.type == "autocomplete") {
                                tempInput.attr('input-model','formData["'+tplData.resource+'"]');
                            }else{
                                tempInput.attr('input-model', 'formData["'+tplData.name+'"]');
                            }

                            tempInput.attr('input-required', tplData.required);
                            tempInput.attr('input-pattern', tplData.regex);
                            tempInput.attr('input-pattern-msg', tplData.regexMsg);

                        if (tplData.contextGroup > -1) {
                            if (formGroups[tplData.contextGroup] == null) {
                                formGroups[tplData.contextGroup] =
                                    createContextGroup(scope.data.formGroups[tplData.contextGroup].header);
                                inputCont.append(formGroups[tplData.contextGroup]);
                            }
                            inputGroup.append(tempInput);
                            formGroups[tplData.contextGroup].find('.panel-body').append(inputGroup);

                        } else if (tplData.inputGroup > -1) {
                            if (inputGroups[tplData.inputGroup] == null) {
                                inputGroups[tplData.inputGroup] = inputGroup;
                                if (typeof scope.data.inputGroups[tplData.inputGroup].contextGroup != "undefined") {
                                    formGroups[scope.data.inputGroups[tplData.inputGroup].contextGroup].find(".panel-body")
                                        .append(inputGroups[tplData.inputGroup]);
                                } else {
                                    inputCont.append(inputGroups[tplData.inputGroup]);
                                }
                            }
                            inputGroups[tplData.inputGroup].append(tempInput);
                        } else {
                            inputGroup.append(tempInput);
                            inputCont.append(inputGroup);
                        }
                    }
                    $compile(inputCont)(scope);
                }

            })
        }

        return {
            restrict: 'EA',
            link: link,
            controller: 'formController',
            templateUrl: 'app/forms/grid/views/grid-form.html'
        }
    });

    return module;
});