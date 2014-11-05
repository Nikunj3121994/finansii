define([
], function () {
    /**
     * @ngdoc directive
     * @description module that wraps directives for form inputs
     * @name app.forms.inputs.module:customText
     */
    var module = angular.module("app.forms.inputs.dependency", [
        'ui.bootstrap.dateparser'
    ]);

    /**
     * @ngdoc directive
     * @description directive that creates custum input with all validation needed
     * @name app.forms.inputs.customtext.directive:customInput
     */
    module.directive('customDependencyInline', function (summaryService) {
        function link($scope,element){
            var numberTest = /^(-?(\d+\.\d+|\d+|\d+\.|\.\d+)|-)$/;
            var mathFunction=JSON.parse($scope.mathFunction);
            var watches=JSON.parse($scope.dependencyWatch);
            $scope.$watch('inputModel', function (newVal, oldVal) {
                if (!numberTest.test(newVal) && !_.isUndefined(newVal)) {
                    if (numberTest.test(oldVal)) $scope.inputModel = oldVal;
                    else $scope.inputModel = 0;
                }
            });
            for(var i=0;i<watches.length;i++){
                $scope.$watch(watches[i],function(){
                    if(element.find('input').is(':focus')) return;
                    var value=summaryService.calculate(mathFunction,$scope.formData);
                    if(_.isUndefined(value) || _.isNaN(value) || value=='' || value==0) return;
                    $scope.inputModel=value;
                },true);
            }
//            $scope.$watch('formData',function(){
//                if(element.find('input').is(':focus')) return;
//                $scope.inputModel=summaryService.calculate(mathFunction,$scope.formData);
//            },true);
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
                mathFunction:"@",
                formData:"=",
                dependencyWatch:"@"
            },
            replace: true,
            templateUrl: 'app/Forms/Inputs/views/custom-text-input-inline.html',
            link:link
        }
    });
    return module;
});