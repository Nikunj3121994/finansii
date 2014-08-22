define([], function() {

    var module = angular.module("app.forms.grid.filters", []);


    module.filter('range', function () {
        return function (input, total) {
            total = parseInt(total);
            for (var i = 0; i < total; i++)
                input.push(i);
            return input;
        };
    });


    module.filter('orderByColumn', function () {
        return function (items, column, reverse) {

            if (column < 0) return items;
            var filtered = [];
            angular.forEach(items, function (item) {
                filtered.push(item);
            });

            filtered.sort(function (a, b) {
                if (!isNaN(a.cols[column].val)) {

                    return (parseFloat(a.cols[column].val) > parseFloat(b.cols[column].val) ? 1 : -1);
                }
                else return (a.cols[column].val > b.cols[column].val ? 1 : -1);
            });

            if (reverse) filtered.reverse();

            return filtered;

        }
    });


    module.filter('currentPageFilter', function () {
        return function (items, currentPage, itemsPerPage) {
            if (typeof items === "undefined") return
            var filtered = []
            for (var i = (currentPage - 1) * itemsPerPage; i < currentPage * itemsPerPage; i++) {
                if (items[i] == null) break;
                filtered.push(items[i]);
            }
            return filtered;
        }
    });

    return module;
});