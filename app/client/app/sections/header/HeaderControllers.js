define([], function() {
    var module = angular.module('app.header.controllers', []);

    module.controller('headerController', ['$scope', '$translate', function ($scope, $translate) {
        $scope.changeLanguage = function (lang) {
            $translate.use(lang);
        }
    }]);

    return module;
});