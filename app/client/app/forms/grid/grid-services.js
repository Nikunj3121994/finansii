define([], function() {

    var module = angular.module("app.forms.grid.services", [])

    module.factory('jsonGridDataService', ["$q", "$http" , function ($q, $http) {
        this.getData = function (dataUrl) {
            var deferred = $q.defer(),
                start = new Date().getTime();

            $http({
                url: dataUrl,
                method: "GET"
            })
                .success(function (data) {
                    console.log("Success getting testform.json [", (new Date().getTime() - start) + 'ms ]\n', data);

                    //Extend colsSettings to enable column visible property
                    $.each(data.colsSettings, function (i, v) {
                        $.extend(v, {
                            visible: i < 5
                        });
                    });
                    deferred.resolve(data);

                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        };
        this.getConfig=function(resource){
            var deferred = $q.defer();

            var resourceUrl="http://localhost/finansii/api/public/config";
            $http({
                url: resourceUrl,
                method: "GET"
            })
                .success(function (data) {
                    deferred.resolve(data[resource]);
                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        }

        this.getResource=function(resource){
            var deferred = $q.defer();

            var resourceUrl="http://localhost/finansii/api/public/"+resource;
            $http({
                url: resourceUrl,
                method: "GET"
            })
                .success(function (data) {
                    deferred.resolve(data.body);
                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        }
        return this;
    }]);


    return module;
});