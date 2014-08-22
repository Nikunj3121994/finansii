define([], function() {
    var module = angular.module("app.reports.templates.simple1", []);

    module.directive('simpleReport1', function () {
        function link($scope, element, attrs) {
            $scope.data = {}; // init the protoModels

            $scope.data.header = {
                title: 'Рекапитулација',
                subTitle: 'овде сејт нешо јако сигурно',
                imeFirma: 'Јонгис доо',
                dateFrom: '12.12.2012',
                dateTo: '12.12.2013'
            }
        }

        return {
            restrict: 'EA',
            replace: true,
            scope: true,
            link: link,
            templateUrl: 'app/reports/templates/simple1/simple-report1.html'
        }
    });

    return module;
});

