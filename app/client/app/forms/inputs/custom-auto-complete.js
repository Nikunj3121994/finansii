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
    module.directive('customAutoCompleteInline',function($timeout,autoCompleteService,$filter){
        function link($scope){
            $scope.dependencyValid=function(){
                if(_.isUndefined($scope.dependencyModel) && !_.isUndefined($scope.dependencyField)){
                    return true;
                }
                return false;
            };
            $scope.getAutoCompleteData=function(val){
                var extraParams={};

                if(!_.isUndefined($scope.dependencyModel)){
                    if($scope.dependencyModel instanceof Date && !isNaN($scope.dependencyModel.valueOf())){
                        extraParams[$scope.dependencyField]=$filter('date')($scope.dependencyModel,"yyyy-MM-dd HH:mm:ss");
                    }
                    else if(_.isObject($scope.dependencyModel))
                        extraParams[$scope.dependencyField]=$scope.dependencyModel[$scope.dependencyField];
                    else extraParams[$scope.dependencyField]=$scope.dependencyModel;
                }
                return autoCompleteService.getAutoCompleteData($scope.resource,val,extraParams).then(function(data){
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
                field:"@",
                dependencyModel:"=?",
                dependencyField:"@?"
            },
            templateUrl:'app/Forms/Inputs/views/custom-auto-complete-inline.html',
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