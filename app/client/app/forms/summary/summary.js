define([
    'forms/summary/summary-controllers',
    'forms/summary/summary-directives'
], function () {
    var module = angular.module("app.forms.summary",
        [
            "app.forms.summary.controllers",
            "app.forms.summary.directives"
        ]
    );
    return module;
});