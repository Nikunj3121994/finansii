define([], function() {
    /**
     * @ngdoc directive
     * @description Module that wraps all directives the are used in the grid
     * @name app.components.grid.module:directives
     */
    var module = angular.module("app.components.summary.directives", []);

    module.directive('summary', function ($compile) {
        var scope = {
            data: '=',
            calculations: '='
        };

        var link = function ($scope, element, attr) {
            $.each($scope.calculations, function (i, val) {
                val.modelFunction = $scope.formulas.calculate;
            });
        };


        return {
            restrict: 'E',
            scope: scope,
            link: link,
            controller: 'summaryController',
            template:'app/components/summary/views/summary.html'
        }
    });


    return module;
});