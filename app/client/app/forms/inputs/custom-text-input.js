define([
], function () {
    /**
     * @ngdoc directive
     * @description module that wraps directives for form inputs
     * @name app.forms.inputs.module:customText
     */
    var module = angular.module("app.forms.inputs.customText", [
        'ui.bootstrap.dateparser'
    ]);

    /**
     * @ngdoc directive
     * @description directive that creates custum input with all validation needed
     * @name app.forms.inputs.customtext.directive:customInput
     */
    module.directive('customInput', function () {

        return {
            restrict: 'EA',
            scope: {
                inputName: "@",
                inputLabel: "@",
                inputModel: "=",
                inputRequired: "@?",
                inputPattern: "@?",
                inputPatternMsg: "@?",
                customMask: "@"
            },
            replace: true,
            templateUrl: 'app/Forms/Inputs/views/custom-text-input.html'
        }
    });
    module.directive('customInputInline', function () {

        return {
            restrict: 'EA',
            scope: {
                inputName: "@",
                inputLabel: "@",
                inputModel: "=",
                inputRequired: "@?",
                inputPattern: "@?",
                inputPatternMsg: "@?",
                customMask: "@"
            },
            replace: true,
            templateUrl: 'app/Forms/Inputs/views/custom-text-input-inline.html'

        }
    });


    //TODO DA SE VIDIT SO E SO TERMINAL RABOTAVA
    module.directive("dynamicName", function ($compile) {
        return {
            restrict: "A",
            terminal: true,
            priority: 1000,
            link: function (scope, element, attrs) {
                var name = scope.$eval(attrs.dynamicName);
                if (name) {
                    element.attr('name', name);
                    element.removeAttr("dynamic-name");
                    $compile(element)(scope);
                }
            }
        };
    })

    module.directive('notificationMessages', function () {

        function link($scope, element, attr, ngModelCtrl) {
            // Trigger validation events on focusout
            element.focusout(function () {
                $scope.$apply();
            });

            $scope.showRequiredMessage = function () {
                return ngModelCtrl.$error['required']
                    && ngModelCtrl.$dirty
                    && !element.is(':focus');
            };
            $scope.showPatternMismatchedMessage = function () {
                return ngModelCtrl.$error['customPattern']
                    && ngModelCtrl.$dirty
                    && !element.is(':focus');
            }
        }


        return {
            restrict: 'A',
            priority: 1000,
            require: '?ngModel',
            link: link
        }
    });
    module.directive('customMask', function ($filter, dateParser) {
        function link($scope, element, attr, ctrl) {
            $scope.maskedValue = "";
            $scope.value = "";
            $scope.model = null;
            $scope.maskValidation = getMaskFromString(attr.customMask);
            if (attr.datepickerPopup) {
                $scope.inputType = "date";
            } else {
                $scope.inputType = "text";
            }
            function getMaskFromString(mask) {
                var maskValidation = [];
                for (var i = 0; i < mask.length; i++) {
                    if (mask[i] == '9') {
                        maskValidation.push({
                            type: 1,
                            value: '[0-9]'
                        });
                    } else if (mask[i] == 'a') {
                        maskValidation.push({
                            type: 1,
                            value: '([a-z]|[A-Z])'
                        });
                    } else {
                        maskValidation.push({
                            type: 0,
                            value: mask[i]
                        });
                    }
                }
                return maskValidation;
            }

            function maskValue(value, maskValidation) {
                var maskedValue = '';
                for (var i = 0, j = 0; i < maskValidation.length; i++) {
                    if (maskValidation[i].type == 0) {
                        maskedValue += maskValidation[i].value;
                        continue;
                    }
                    if (_.isUndefined(value)) {
                        maskedValue += "_";
                        j++;
                        continue;
                    }
                    if (_.isUndefined(value[j])) {
                        maskedValue += "_";
                        j++;
                        continue;
                    }
                    if (!_.isUndefined(value[j])) {
                        var regexp = new RegExp(maskValidation[i].value);
                        if (regexp.test(value[j])) {
                            maskedValue += value[j];
                        } else {
                            maskedValue += "_";
                        }
                        j++;
                    }


                }

                return maskedValue;
            }

            function unMaskValue(maskedValue, maskValidation) {
                if(_.isUndefined(maskedValue)){
                    maskedValue=attr.placeholder;
                }
                maskedValue = maskedValue.replace(/_/g, '');
                var tmpMaskedValue = maskedValue;
                var trueValueLength = maskedValue.length;
                if (_.isUndefined(maskedValue)) return value;
                for (var i = 0; i < maskValidation.length; i++) {
                    if (maskValidation[i].type == 0) {

                        if (tmpMaskedValue.indexOf(maskValidation[i].value) > -1 &&
                            tmpMaskedValue.indexOf(maskValidation[i].value) != i) trueValueLength--;
                        tmpMaskedValue = setCharAt(tmpMaskedValue, tmpMaskedValue.indexOf(maskValidation[i].value), "*");
                        tmpMaskedValue[tmpMaskedValue.indexOf(maskValidation[i].value)] = "*";

                        maskedValue = maskedValue.replace(maskValidation[i].value, '');

                    }
                }
                return {
                    unMaskedValue: maskedValue,
                    length: trueValueLength
                };
            }

            function setCharAt(str, index, chr) {
                if (index > str.length - 1) return str;
                return str.substr(0, index) + chr + str.substr(index + 1);
            }


            ctrl.$formatters.unshift(function (modelValue) {
                if ($scope.inputType == "date") {
                    try{
                        var model=dateParser.parse(modelValue.split(' ')[0],"yyyy-MM-dd");
                        if(!_.isUndefined(model)){
                            return $filter('date')(model, attr.datepickerPopup);
                        }else{
                            return model;
                        }

                    }catch(ex) {
                        return $filter('date')(modelValue, attr.datepickerPopup);
                    }


                }
                if (_.isUndefined(modelValue)) return '';
                return modelValue;
            });
            ctrl.$parsers.unshift(function (viewValue) {
                if(viewValue instanceof Date && !isNaN(viewValue.valueOf())){
                    viewValue = $filter('date')(viewValue, attr.datepickerPopup);
                }
                if (!_.isNaN(Date.parse(viewValue)) && element[0].selectionStart > $scope.maskValidation.length - 1) {
                    viewValue = $filter('date')(viewValue, attr.datepickerPopup);
                }
                $scope.cursorPos = element[0].selectionStart;
                if (element[0].selectionStart < $scope.maskValidation.length &&
                    element[0].selectionStart != 0 &&
                    $scope.maskValidation[element[0].selectionStart - 1].type == 0) {

                    var tmpChar = viewValue[element[0].selectionStart];
                    viewValue = setCharAt(viewValue, element[0].selectionStart, viewValue[element[0].selectionStart - 1]);
                    viewValue = setCharAt(viewValue, element[0].selectionStart - 1, tmpChar);
                    element[0].selectionStart++;
                    $scope.cursorPos = element[0].selectionStart;
                }
                var newValue = unMaskValue(viewValue, $scope.maskValidation);
                $scope.maskedValue = maskValue(newValue.unMaskedValue, $scope.maskValidation);
                element.val($scope.maskedValue);
                ctrl.$viewValue = $scope.maskedValue;
                if ($scope.cursorPos <= newValue.length) {
                    if ($scope.cursorPos > 0 && $scope.cursorPos < $scope.maskValidation.length + 1
                        && $scope.maskValidation[$scope.cursorPos - 1].type == 1 &&
                        new RegExp($scope.maskValidation[$scope.cursorPos - 1].value).test(viewValue[$scope.cursorPos - 1]))
                        element[0].setSelectionRange($scope.cursorPos, $scope.cursorPos);
                    else {
                        element[0].setSelectionRange($scope.cursorPos - 1, $scope.cursorPos - 1);
                    }
                } else {
                    element[0].setSelectionRange(newValue.length, newValue.length);
                }
                if ($scope.inputType == "date") {
                    var dateView = dateParser.parse($scope.maskedValue, attr.datepickerPopup);
                    if (!_.isUndefined(dateView)) {
                        return dateView;
                    } else return null;
                }
                if (_.isUndefined(viewValue)) return '';
                return newValue.unMaskedValue;
            });
        }

        return {
            restrict: 'A',
            require: '?ngModel',
            link: link
        }
    });


    /* ng-pattern fix, problems with ui-mask */
    module.directive('customPattern', function ($filter) {
        function link($scope, element, attr, ngModelCtrl) {
            var regex = new RegExp(attr['customPattern']);
            $scope.$watch(attr.ngModel, function (newValue, oldValue) {
                if (attr.datepickerPopup) {
                    newValue = $filter('date')(newValue, attr.datepickerPopup);
                }
                ngModelCtrl.$setValidity("customPattern", regex.test(newValue));
            });
        }

        return {
            restrict: 'A',
            require: '?ngModel',
            link: link
        }
    });
    return module;
});