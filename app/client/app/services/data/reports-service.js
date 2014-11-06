define([
], function () {
    var module = angular.module('app.services.data.reports', []);
    module.factory('reportService',function($q, $http,toasterService,configService){
        this.getReport=function(filters,report){
            $(configService.loading).fadeIn();
            var deferred = $q.defer(),
                start = new Date().getTime();
            var reportUrl=configService.resourseUrl+"reports/"+report;
            $http({
                url: reportUrl,
                params:filters,
                method: "GET"
            })
                .success(function (data) {
                    if(data.code)
                        if(data.code>0){
                            toasterService.setWarning(data.msg);
                        }else {
                            toasterService.setInfo(data.msg);
                        }
                    else{
                        if(data.error.code>0){
                            toasterService.setWarning(data.error.msg);
                        }else {
                            toasterService.setInfo(data.error.msg);
                        }
                    }
                    deferred.resolve(data);
                    $(configService.loading).fadeOut();
                })
                .error(function (data) {
                    toasterService.setError("Error getting resource");
                    deferred.reject("There was and error.");
                    $(configService.loading).fadeOut();
                });

            return deferred.promise;
        };
        return this;
    });
    return module;
});