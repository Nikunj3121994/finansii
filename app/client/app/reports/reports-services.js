define([
], function () {
    var module = angular.module('app.reports.services', []);
    module.factory('reportService',function($q, $http,toasterService){
        this.getReport=function(filters,report){
            $('.loading-animation').fadeIn();
            var deferred = $q.defer(),
                start = new Date().getTime();
            var reportUrl="http://localhost/finansii/api/public/reports/"+report;
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
                    $('.loading-animation').fadeOut();
                })
                .error(function (data) {
                    toasterService.setError("Error getting resource");
                    deferred.reject("There was and error.");
                    $('.loading-animation').fadeOut();
                });

            return deferred.promise;
        }
        return this;
    });
    return module;
});