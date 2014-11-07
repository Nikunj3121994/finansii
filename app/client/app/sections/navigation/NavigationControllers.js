define([], function() {
    var module = angular.module('app.navigation.controllers', [])

    /**
     * Main controller for side navigation
     * @controller
     */
    module.controller('navigationController', ['$scope', function ($scope) {
        $scope.demoData = [
            {
                name: "Dashboard",
                link: "dashboard",
                iconClass: "dashboard"
            },
            {
                name: "Admin",
                link: "admin",
                iconClass: "table",
                subMenu: [
                    {
                        name: "Grid",
                        link: "grid/Ime"
                    },
                    {
                        name: "Order",
                        link: "order"
                    },
                    {
                        name: "Date",
                        link: "date"
                    },
                    {
                        name: "Reports",
                        link: "reports"
                    }
                ]
            },
            {
                name: "404",
                link: "404",
                iconClass: "frown-o"
            }
        ];
    }]);

    return module;
});