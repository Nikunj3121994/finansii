define([
], function () {
    var module = angular.module("app.forms.inputs.services",[]);
    module.factory('autoCompleteService', ["$q", "$http" , function ($q, $http) {
        this.getAutoCompleteData = function (resource,value,extraParams) {
            var deferred = $q.defer();
            var params={val:value};
            if(!_.isUndefined(extraParams)){
                _.extend(params,extraParams);
            }
            var url="http://localhost/finansii/api/public/"+resource;
            $http({
                url: url,
                params:params,
                method: "GET"
            })
                .success(function (data) {
                    if(data.code) deferred.resolve([]);
                    if(_.isArray(data.body)){
                        deferred.resolve(data.body);
                    }else{
                        deferred.resolve([data.body]);
                    }


                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        };
        return this;
    }]);

});