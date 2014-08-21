define([
    'sections/header/HeaderDirectives',
    'sections/header/HeaderControllers'
], function () {
    var module = angular.module('app.header', [
        'app.header.directives',
        'app.header.controllers'
    ])
    return module;
});