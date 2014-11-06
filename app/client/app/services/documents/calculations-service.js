define([],function(){
   return angular.module('app.services.documents.calculations',[])
       .factory('calculationService', ["$q", "$http","configService" , function ($q, $http,configService) {
       this.saveCalculation = function (data) {
           var deferred = $q.defer();

           var url = configService.resourseUrl+"calculation-headers";
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
       this.editCalculation = function (data,id) {
           var deferred = $q.defer();

           var url = configService.resourseUrl+"calculation-headers/"+id;
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
       this.archiveCalculation = function (calculationHeaderId) {
           var deferred = $q.defer();

           var url = configService.resourseUrl+"archive-calculations";
           $http({
               url: url,
               data: {calculationHeaderId:calculationHeaderId},
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