define([], function() {

    var module = angular.module("app.forms.grid.services", [])

    module.factory('jsonGridDataService', ["$q", "$http" , function ($q, $http) {
        this.getData = function (dataUrl,params) {
            if(_.isUndefined(params)){
                params={};
            }
            var deferred = $q.defer(),
                start = new Date().getTime();

            $http({
                url: dataUrl,
                params:params,
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

        this.getResource=function(resource,params){
            var deferred = $q.defer();
            if(_.isUndefined(params)){
                params={};
            }
            var resourceUrl="http://localhost/finansii/api/public/"+resource;
            $http({
                url: resourceUrl,
                params:params,
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
        this.saveResource=function(resource,data,params){
            if(!_.isUndefined(params)){
                _.extend(data,params);
            }
            var deferred = $q.defer();
            var resourceUrl="http://localhost/finansii/api/public/"+resource;
            $http({
                url: resourceUrl,
                data:data,
                method: "POST"
            })
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        }
        this.editResource=function(resource,data,id,params){
            if(!_.isUndefined(params)){
                _.extend(data,params);
            }
            var deferred = $q.defer();
            var resourceUrl="http://localhost/finansii/api/public/"+resource+"/"+id;
            $http({
                url: resourceUrl,
                data:data,
                method: "PUT"
            })
                .success(function (data) {
                    deferred.resolve(data);
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