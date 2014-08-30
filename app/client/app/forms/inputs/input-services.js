define([
], function () {
    var module = angular.module("app.forms.inputs.services",[]);
    module.factory('autoCompleteService', ["$q", "$http" ,"toasterService", function ($q, $http,toasterService) {
        this.getAutoCompleteData = function (resource,value,extraParams) {
            $('.loading-animation').fadeIn();
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
                    $('.loading-animation').fadeOut();

                })
                .error(function (data) {
                    toasterService.setError('Error getting resource');
                    $('.loading-animation').fadeOut();
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        };
        return this;
    }]);

});