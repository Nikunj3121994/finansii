define([],function(){
   return angular.module('app.services.auth',[]).factory('authService',['$q', '$http', 'toasterService', 'configService', function($q,$http,toasterService,configService){
       this.login=function(username,password){
           $('.loading-animation').fadeIn();
           var deferred = $q.defer();
           var url=configService.resourseUrl+"auth";
           $http({
               url: url,
               params:{username:username,password:password},
               method: "POST"
           })
               .success(function (data) {
                   if(data.code==405){
                       toasterService.setWarning(data.msg);
                       deferred.reject(data);
                   }else{
                       toasterService.setSuccess('Succesful login');
                       deferred.resolve(data);
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
       this.logout=function(){
           $('.loading-animation').fadeIn();
           var deferred = $q.defer();
           var url=configService.resourseUrl+"auth";
           $http({
               url: url,
               method: "DELETE"
           })
               .success(function (data) {
                   console.log(data);
                   if(data.code==405){
                       toasterService.setWarning(data.msg);
                       deferred.reject(data);
                   }else{
                       toasterService.setSuccess('Succesful login');
                       deferred.resolve(data);
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