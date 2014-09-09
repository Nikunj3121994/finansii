define([], function () {

    var module = angular.module('app.pages.login', []);
    module.controller('loginController',function($scope,loginService,$http,$state){
        $scope.login=function(){
            loginService.login($scope.username,$scope.password).then(function(data){
                $http.defaults.headers.common['X-Auth-Token']=data.token;
                $state.go('dashboard');
            });
        }
    });
    module.factory('loginService',function(toasterService,$q,$http){
       this.login=function(username,password){
           $('.loading-animation').fadeIn();
           var deferred = $q.defer();
           var url="http://localhost/finansii/api/public/auth";
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
       this.checkLogin=function(){

       }
        return this;
    });
});