define([
], function () {
    var module = angular.module("app.forms.inputs.customAutoComplete",[
        'ui.bootstrap'
    ]);
    module.directive('customAutoComplete',function($timeout,autoCompleteService){
        function link($scope){
            $scope.getAutoCompleteData=function(val){
               return autoCompleteService.getAutoCompleteData($scope.resource,val).then(function(data){
                    if(data.length>0) $scope.selectedRow=0;
                   return data;
                });
            }
        }
        return {
            restrict:'A',
            scope:{
                inputName: "@",
                inputLabel: "@",
                inputModel: "=",
                inputRequired: "@?",
                inputPattern: "@?",
                inputPatternMsg: "@?",
                resource:"@",
                field:"@"
            },
            templateUrl:'app/Forms/Inputs/views/custom-auto-complete.html',
            replace: true,
            link:link
        }
    });
    module.directive('autoCompleteModelCast',function(){
       function link($scope,element,attr,ngModelCtrl){
           ngModelCtrl.$formatters.unshift(function (modelValue) {
               if(_.isUndefined(modelValue)) return '';
                return modelValue[$scope.field];
           });
           ngModelCtrl.$parsers.unshift(function (viewValue) {
                return null;
           });
       }

        return{
            restrict:'A',
            link:link,
            require: '?ngModel'
        }
    });
    return module;
});