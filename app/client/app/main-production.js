'use strict';
require.config({
    paths: {
        //ova morase da e ovde imat bag valda
        angularCache: '../bower_components/angular-cache/dist/angular-cache'
    },
    shim: {
    }
});

// http://code.angularjs.org/1.2.1/docs/guide/bootstrap#overview_deferred-bootstrap
// window.name = "NG_DEFER_BOOTSTRAP!";

require([
    'app',
    'templates'
], function (app) {
    var $html = angular.element(document.getElementsByTagName('html')[0]);

    angular.element().ready(function () {
        angular.resumeBootstrap(['app']);
    });
});