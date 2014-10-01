define([], function() {
    /**
     * @ngdoc overview
     * @description module that wraps directives for form inputs
     * @name inputs.module:customSpinner
     * @module inputs
     */
    var module = angular.module("app.forms.inputs.customSpinner", []);

    /**
     * @ngdoc directive
     * @description directive that creates custum input with all validation needed that is user vo number values
     * @name inputs.directive:customSpinner
     * @module inputs
     */
    module.directive('customSpinner', function () {
        function link($scope) {
            var numberTest = /^(-?(\d+\.\d+|\d+|\d+\.|\.\d+)|-)$/;
            $scope.$watch('inputModel', function (newVal, oldVal) {
                if(_.isUndefined(newVal) || newVal=='') return;
                if (!numberTest.test(newVal) && !_.isUndefined(newVal)) {
                    if (numberTest.test(oldVal)) $scope.inputModel = oldVal;
                    else $scope.inputModel = undefined;
                }
            });
            $scope.increment = function () {
                if (_.isUndefined($scope.inputModel)) $scope.inputModel = 0;
                $scope.inputModel = (parseFloat($scope.inputModel) + 1).toString();
            };
            $scope.decrement = function () {
                if (_.isUndefined($scope.inputModel)) $scope.inputModel = 0;
                $scope.inputModel = (parseFloat($scope.inputModel) - 1).toString();
            };

        }

        return {
            restrict: 'EA',
            scope: {
                inputName: "@",
                inputLabel: "@",
                inputModel: "=",
                inputRequired: "@?",
                inputPattern: "@?",
                inputPatternMsg: "@?",
                customMask: "@",
                inline:"@?"
            },
            replace: true,
            templateUrl: 'app/Forms/Inputs/views/custom-spinner-input.html',
            link: link
        }
    });

    module.directive('customSpinnerInline', function () {
        function link($scope) {
            var numberTest = /^(-?(\d+\.\d+|\d+|\d+\.|\.\d+)|-)$/;
            $scope.$watch('inputModel', function (newVal, oldVal) {
                if (!numberTest.test(newVal) && !_.isUndefined(newVal)) {
                    if (numberTest.test(oldVal)) $scope.inputModel = oldVal;
                    else $scope.inputModel = 0;
                }
            });
            $scope.increment = function () {
                if (_.isUndefined($scope.inputModel)) $scope.inputModel = 0;
                $scope.inputModel = (parseFloat($scope.inputModel) + 1).toString();
            };
            $scope.decrement = function () {
                if (_.isUndefined($scope.inputModel)) $scope.inputModel = 0;
                $scope.inputModel = (parseFloat($scope.inputModel) - 1).toString();
            };
        }

        return {
            restrict: 'EA',
            scope: {
                inputName: "@",
                inputLabel: "@",
                inputModel: "=",
                inputRequired: "@?",
                inputPattern: "@?",
                inputPatternMsg: "@?",
                customMask: "@",
                inline:"@?"
            },
            replace: true,
            templateUrl: 'app/Forms/Inputs/views/custom-spinner-input-inline.html',
            link: link
        }
    });

    return module;
});