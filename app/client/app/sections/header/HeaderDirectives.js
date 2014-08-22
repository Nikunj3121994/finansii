define([], function() {
    var module = angular.module('app.header.directives', []);
    module.directive('customHeader', [function () {
            return {
                restrict: 'EA',
                controller: 'headerController',
                templateUrl: 'app/sections/header/views/header.html'
            }
        }]);

    return module;
});