define([],function(){
   return angular.module('app.services.documents.orders',[])
       .factory('ordersService', ["$q", "$http","configService" , function ($q, $http,configService) {
        this.saveOrder = function (data) {
            var deferred = $q.defer();

            var url =configService.resourseUrl+"orders";
            $http({
                url: url,
                data: data,
                method: "POST"
            })
                .success(function (data) {
                    if (data.code) deferred.resolve(data);
                    else deferred.resolve(data.body);



                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        };
        this.editOrder = function (data,id) {
            var deferred = $q.defer();

            var url = configService.resourseUrl+"orders/"+id;
            $http({
                url: url,
                data: data,
                method: "PUT"
            })
                .success(function (data) {
                    if (data.code) deferred.resolve(data);
                    else deferred.resolve(data.body);



                })
                .error(function (data) {
                    console.log("Error getting testform.json");
                    deferred.reject("There was and error.");
                });

            return deferred.promise;
        };
        this.archiveOrder = function (orderId,companyCode) {
            var deferred = $q.defer();

            var url = configService.resourseUrl+"archive-ledgers";
            $http({
                url: url,
                data: {orderId:orderId,companyCode:companyCode},
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
        };
        return this;
    }]);
});