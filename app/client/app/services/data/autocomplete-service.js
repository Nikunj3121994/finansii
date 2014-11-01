define([
], function () {
    var module = angular.module("app.services.autocomplete",[]);
    module.factory('autoCompleteService', ["$q", "$http" ,"toasterService","loadingService",'configService',
        function ($q, $http,toasterService,loadingService,configService) {
        this.getAutoCompleteData = function (resource,value,extraParams) {
            loadingService.show();
            var deferred = $q.defer();
            var params={val:value};
            if(!_.isUndefined(extraParams)){
                _.extend(params,extraParams);
            }
            var url=configService.resourseUrl+resource;
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
                    loadingService.hide()

                })
                .error(function (data) {
                    toasterService.setError('Error getting resource');
                    loadingService.hide();
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        };
        return this;
    }]);

});