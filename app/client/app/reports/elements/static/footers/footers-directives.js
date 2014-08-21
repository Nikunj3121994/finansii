define([
], function () {
    var module = angular.module("app.reports.elements.footers.directives", []);

    module.directive('reportHeader', function () {

        return {
            restrict: 'EA',
            replace: true,
            scope: true
        }
    });

    return module;
});

