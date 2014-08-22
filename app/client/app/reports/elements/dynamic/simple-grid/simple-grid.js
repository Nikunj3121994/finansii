define([
], function () {
    var module = angular.module("app.reports.elements.simple-grid", [
        'pasvaz.bindonce'
    ]);

    module.directive('simpleGrid', function () {
        function controller($scope, $http) {
            console.log($scope);
            $http.get('test_api/simple-report-data.json').success(function (data) {
                $scope.mockData = data;
            });
        }

        return {
            restrict: 'EA',
            replace: true,
            scope: true,
            controller: controller,
            templateUrl: 'app/reports/elements/dynamic/simple-grid/simple-grid.html'
        }
    });

    module.directive('simpleGridRepeat', function () {
        function link($scope, element, attrs) {
            var data = $scope.$eval(attrs.simpleGridRepeat);

            $scope.$watch('mockData', function (data) {
                element.empty();
                _.each(data, function (row) {
                    var rowHtml = document.createElement('div');
                    rowHtml.className = 'print-row';
                    _.each(row, function (cell) {
                        var spanHtml = document.createElement('span');
                        spanHtml.innerHTML = cell;
                        rowHtml.appendChild(spanHtml);
                    });
                    element.append(rowHtml);
                });
                if(!_.isUndefined(data)) {
                    $scope.$emit('allRowsRendered');
                }
            });
        }

        return {
            restrict: 'A',
            link: link
        }
    });


    return module;
});

