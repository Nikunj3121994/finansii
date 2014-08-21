define([
    'sections/navigation/NavigationDirectives',
    'sections/navigation/NavigationControllers'
], function () {
    var module = angular.module('app.navigation', [
        'app.navigation.directives',
        'app.navigation.controllers'
    ]);

    return module;
});