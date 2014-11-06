define([], function() {
    /**
     * @ngdoc controller
     * @name app.components.grid.module:controllers
     * @description module that wraps all controlers needed for custum grid directive
     */
    var module = angular.module("app.components.summary.controllers", []).controller('summaryController', function ($scope) {
        $scope.formulas = {};
        $scope.formulas.sumColumn = function (args) {
            /*expectedObject
             {
             column:\d+,
             range:{
             from:\d+,
             to:\d+
             }
             }
             */
            if (typeof args.column == "undefined") return 'Undefined column';
            var column = args.column;
            if (typeof $scope.data == "undefined") return 'Data not ready';
            var dataRange = {};
            if (args.range == null) {
                dataRange.from = 0;
                dataRange.to = $scope.data.length;
            } else {
                dataRange.from = args.range.from;
                dataRange.to = args.range.to;
            }
            var sum = 0;
            for (var i = dataRange.from; i < dataRange.to; i++) {
                sum += parseInt($scope.data[i].cols[column].val) || 0;
            }
            return sum;
        };
        $scope.formulas.diffColumns = function (args) {
            /*expectedObject
             {
             column1:\d+,
             column2:\d+
             }
             */
            if (_.isUndefined(args.column1)) return 'Undefined column1';
            if (_.isUndefined(args.column1)) return 'Undefined column2';
            return $scope.sumColumn(args.column1) - $scope.sumColumn(args.column2);
        };
        $scope.formulas.diff = function (args) {
            return args.val1 - args.val2;
        };
        $scope.formulas.calculate = function callculate(args) {

            var formula = args.formula;
            var funcArgs = _.clone(args.funcArgs);
            for (var key in args.funcArgs) {
                if (key == 'properties') continue;
                if (_.has(args.funcArgs[key], 'formula')) {
                    funcArgs[key] = $scope.formulas.calculate(args.funcArgs[key]);
                }
            }

            return $scope.formulas[formula](funcArgs);
        }
    });
    return module;
});

