define([], function() {

    var module = angular.module("app.components.grid.filters", ['ui.bootstrap.dateparser']);


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
                if (!isNaN(a[column])) {

                    return (parseFloat(a[column]) > parseFloat(b[column]) ? 1 : -1);
                }
                else return (a[column] > b[column] ? 1 : -1);
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

    module.filter('customDate', ['$filter', 'dateParser', function ($filter,dateParser) {
        return function (item, format) {
            try{
                var model=dateParser.parse(item.split(' ')[0],"yyyy-MM-dd");
                if(!_.isUndefined(model)){
                    return $filter('date')(model, format);
                }else{
                    return model;
                }
            }catch(ex){
                return $filter('date')(item,format);
            }


        }
    }]);

    return module;
});