define([
    'components/summary/summary-controllers',
    'components/summary/summary-directives'
], function () {
    var module = angular.module("app.components.summary",
        [
            "app.components.summary.controllers",
            "app.components.summary.directives"
        ]
    );
    return module;
});