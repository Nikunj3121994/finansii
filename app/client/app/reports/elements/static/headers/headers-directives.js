define([
], function () {
    var module = angular.module("app.reports.elements.headers.directives", []);

    module.directive('reportHeader', function () {

        return {
            restrict: 'EA',
            replace: true,
            scope: true,
            templateUrl: 'app/reports/elements/static/headers/views/report-header.html'
        }
    });

    return module;
});

