define([], function () {

    var module = angular.module('app.pages.login', []);
    module.run(function(navigationService){
        var state={
            label:'Sign in',
            name:'login',
            parent:null
        }
        navigationService.addState(state,state.name,state.parent);
    });
    module.controller('loginController',function($scope,loginService,$http,$state,$rootScope){

        $scope.login=function(){
            loginService.login($scope.username,$scope.password).then(function(data){
                $http.defaults.headers.common['X-Auth-Token']=data.token;
                localStorage.setItem('token',data.token);
                if(!_.isUndefined($rootScope.previousState)) $state.go($rootScope.previousState,$rootScope.previousStateParams);
                else $state.go('dashboard');
            });
        }
    });
    module.factory('loginService',function(toasterService,$q,$http,configService){
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
           var url="http://localhost/finansii/api/public/auth";
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
    });
});