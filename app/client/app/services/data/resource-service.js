define([], function() {

    var module = angular.module("app.services.data.resources", []);

    module.factory('jsonGridDataService', ["$q", "$http","toasterService","configService" , function ($q, $http,toasterService,configService) {
        this.getData = function (dataUrl,params) {
            $('.loading-animation').fadeIn();
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
                    $('.loading-animation').fadeOut();
                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                    $('.loading-animation').fadeOut();
                });

            return deferred.promise;
        };
        this.getConfig=function(resource){
            $('.loading-animation').fadeIn();
            var deferred = $q.defer();

            var resourceUrl=configService.resourseUrl+"config";
            $http({
                url: resourceUrl,
                method: "GET"
            })
                .success(function (data) {
                    deferred.resolve(data[resource]);
                    $('.loading-animation').fadeOut();
                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                    $('.loading-animation').fadeOut();
                });

            return deferred.promise;
        };

        this.getResource=function(resource,params){
            $('.loading-animation').fadeIn();
            var deferred = $q.defer();
            if(_.isUndefined(params)){
                params={};
            }
            var resourceUrl=configService.resourseUrl+resource;
            $http({
                url: resourceUrl,
                params:params,
                method: "GET"
            })
                .success(function (data) {
                    if(data.error.code>0){
                        toasterService.setWarning(data.error.msg);
                    }else {
                        toasterService.setInfo(data.error.msg);
                    }
                    deferred.resolve(data.body);
                    $('.loading-animation').fadeOut();
                })
                .error(function (data) {
                    toasterService.setError("Error getting resource");
                    deferred.reject("There was and error.");
                    $('.loading-animation').fadeOut();
                });

            return deferred.promise;
        };
        this.saveResource=function(resource,data,params){
            $('.loading-animation').fadeIn();
            if(!_.isUndefined(params)){
                _.extend(data,params);
            }
            var deferred = $q.defer();
            var resourceUrl=configService.resourseUrl+resource;
            $http({
                url: resourceUrl,
                data:data,
                method: "POST"
            })
                .success(function (data) {
                    if(data.code>0){
                        toasterService.setWarning(data.msg);
                    }else {
                        toasterService.setSuccess(data.msg);
                    }
                    deferred.resolve(data);
                    $('.loading-animation').fadeOut();
                })
                .error(function (data) {
                    toasterService.setError("Error saving resource");
                    deferred.reject("There was and error.");
                    $('.loading-animation').fadeOut();
                });

            return deferred.promise;
        };
        this.editResource=function(resource,data,id,params){
            $('.loading-animation').fadeIn();
            if(!_.isUndefined(params)){
                _.extend(data,params);
            }
            var deferred = $q.defer();
            var resourceUrl=configService.resourseUrl+resource+"/"+id;
            $http({
                url: resourceUrl,
                data:data,
                method: "PUT"
            })
                .success(function (data) {
                    if(data.code>0){
                        toasterService.setWarning(data.msg);
                    }else {
                        toasterService.setSuccess(data.msg);
                    }
                    deferred.resolve(data);
                    $('.loading-animation').fadeOut();
                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                    $('.loading-animation').fadeOut();
                });

            return deferred.promise;

        };
        return this;
    }]);


    return module;
});