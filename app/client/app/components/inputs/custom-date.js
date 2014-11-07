define([
], function () {
    var module = angular.module("app.components.inputs.customDate", [
        'ui.bootstrap'
    ]);


    module.directive('customDate', ['$filter', function ($filter) {
        function link($scope, element, attr) {
            /* Binded text input model and bootstrap datePicker model
             * text input - parsedModel - string
             * datePicker input - inputModel - Date object
             * using bootstrap-ui dateParser service
             */
            $scope.openDatepicker = function ($event) {
                $event.preventDefault();
                $event.stopPropagation();
                $scope.opened = true;
            };
        }

        return {
            restrict: 'EA',
            link: link,
            scope: {
                inputName: "@",
                inputLabel: "@",
                inputModel: "=",
                inputRequired: "@?",
                inputPattern: "@?",
                inputPatternMsg: "@?",
                inline:"@?"
            },
            replace: true,
            templateUrl: 'app/components/inputs/views/custom-date.html'
        }
    }]);
    module.directive('customDateInline', ['$filter', function ($filter) {
        function link($scope, element, attr) {
            /* Binded text input model and bootstrap datePicker model
             * text input - parsedModel - string
             * datePicker input - inputModel - Date object
             * using bootstrap-ui dateParser service
             */
            $scope.openDatepicker = function ($event) {
                $event.preventDefault();
                $event.stopPropagation();
                $scope.opened = true;
            };

        }

        return {
            restrict: 'EA',
            link: link,
            scope: {
                inputName: "@",
                inputLabel: "@",
                inputModel: "=",
                inputRequired: "@?",
                inputPattern: "@?",
                inputPatternMsg: "@?",
                inline:"@?"
            },
            replace: true,
            templateUrl:'app/components/inputs/views/custom-date-inline.html'
        }
    }]);


    // Novi funkcii za dodavanje na denoj na datum
    // Imat za dosredvenje
    module.directive('addDaysInline', function () {
        function link($scope, element, attrs) {
            var addState = 0;
            $scope.currentNumber = '';

            element.on('keydown', function (event) {
                if (event.which === 13) {
                    if (addState != 0) {
                        $scope.$apply(function () {
                            addDays();
                            $scope.currentNumber = '';
                        });
                        addState = 0;
                        //console.log('Changed addState to', addState);
                        event.preventDefault();
                    }
                } else if (event.which === 107) {
                    if (addState == 0) {
                        addState = 1;
                        //console.log('Changed addState to', addState);
                        event.preventDefault();
                    }
                } else if (event.which === 109) {
                    if (addState == 0) {
                        addState = 2;
                        //console.log('Changed addState to', addState);
                        event.preventDefault();
                    }
                } else if (addState && event.which > 95 && event.which < 106) {
                    processInput(event.which);
                    event.preventDefault();
                }
            });

            function processInput(value) {
                value = (value - 96).toString();
                console.log('addDaysInline is beta');
                $scope.$apply(function () {
                    $scope.currentNumber += value;
                });
            }

            function addDays(days) {
                if (_.isUndefined(days)) days = $scope.currentNumber;
                if (_.isString(days)) days = parseInt(days);
                if (isNaN(days)) return;

                var res = new Date($scope.inputModel);
                if (addState === 1)
                    res.setDate($scope.inputModel.getDate() + days);
                if (addState === 2)
                    res.setDate($scope.inputModel.getDate() - days);
                $scope.inputModel = res;
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });

    module.directive('addDays', function () {
        function link($scope, element, attrs) {
            element.on('keyup', function (event) {
                if (event.which === 13) {
                    var that = $(this);
                    $scope.$apply(function () {
                        addDays(that.val());
                        that.val('');
                    });
                }
            });
            function addDays(days) {
                if (_.isString(days)) days = parseInt(days);
                if (isNaN(days)) return;

                var res = new Date($scope.inputModel);
                res.setDate($scope.inputModel.getDate() + days);
                $scope.inputModel = res;
            }
        }

        return {
            restrict: 'A',
            link: link
        }
    });

    return module;

});