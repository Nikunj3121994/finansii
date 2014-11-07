define([
], function () {
    var module = angular.module("app.components.inputs.dropdown", [
        'ngSanitize',
        'ui.select'
    ]);
    module.directive('customDropdownInline',['jsonGridDataService', '$sce', function(jsonGridDataService,$sce){
        function link($scope){
            $scope.dropdown={};
            $scope.dropdown.data=[];
            jsonGridDataService.getResource($scope.resource).then(function(data){
                $scope.dropdown.data=data;
            });
            $scope.trustAsHtml = function(value) {
                return $sce.trustAsHtml(value);
            };
            $scope.dependencyValid=function(){
                if((_.isUndefined($scope.dependencyModel) || _.isNull($scope.dependencyModel)) && !_.isUndefined($scope.dependencyField)){
                    return true;
                }
                return false;
            }
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
                resource:"@",
                field:"@",
                dependencyModel:"=?",
                dependencyField:"@?"
            },
            link:link,
            replace: true,
            templateUrl:'app/components/inputs/views/custom-dropdown-inline.html'
        }
    }]);
})