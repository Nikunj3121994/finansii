define([
    'forms/summary/summary-controllers',
    'forms/summary/summary-directives',
    'forms/summary/summary-services'
], function () {
    var module = angular.module("app.forms.summary",
        [
            "app.forms.summary.services",
            "app.forms.summary.controllers",
            "app.forms.summary.directives",
        ]
    );
    return module;
});