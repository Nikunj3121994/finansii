define([
    'forms/grid/grid-controllers',
    'forms/grid/grid-directives',
    'forms/grid/grid-filters'
], function () {
    /**
     * @ngdoc overview
     * @name grid
     * @module forms
     * @description module that loads all sub module that are used in grid directive
     */
    var module = angular.module("app.forms.grid",
        [
            "app.forms.grid.controllers",
            "app.forms.grid.directives",
            "app.forms.grid.filters"
        ]
    );

    return module;
});