define([], function() {
    var module = angular.module('app.pages.dashboard', []);

    module.controller('dashboardController', function () {
        console.log("DOGE");
    });

    return module;
});