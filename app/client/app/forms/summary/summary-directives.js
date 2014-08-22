define([], function() {
    /**
     * @ngdoc directive
     * @description Module that wraps all directives the are used in the grid
     * @name app.forms.grid.module:directives
     */
    var module = angular.module('app.forms.summary.directives', []);

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
            templateUrl: 'app/forms/summary/views/summary.html'
        }
    });


    return module;
});