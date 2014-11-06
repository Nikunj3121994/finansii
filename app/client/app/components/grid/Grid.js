define([
    'components/grid/grid-controllers',
    'components/grid/grid-directives',
    'components/grid/grid-filters'
], function () {
    /**
     * @ngdoc overview
     * @name grid
     * @module components
     * @description module that loads all sub module that are used in grid directive
     */
    var module = angular.module("app.components.grid",
        [
            "app.components.grid.controllers",
            "app.components.grid.directives",
            "app.components.grid.filters"
        ]
    );

    return module;
});