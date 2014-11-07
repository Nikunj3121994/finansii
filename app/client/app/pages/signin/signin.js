define([], function () {

    var module = angular.module('app.pages.login', []);
    module.run(['navigationService', function(navigationService){
        var state={
            label:'Sign in',
            name:'login',
            parent:null
        }
        navigationService.addState(state,state.name,state.parent);
    }]);
    module.controller('loginController',['$scope', 'authService', '$http', '$state', '$rootScope', function($scope,authService,$http,$state,$rootScope){

        $scope.login=function(){
            authService.login($scope.username,$scope.password).then(function(data){
                $http.defaults.headers.common['X-Auth-Token']=data.token;
                localStorage.setItem('token',data.token);
                if(!_.isUndefined($rootScope.previousState)) $state.go($rootScope.previousState,$rootScope.previousStateParams);
                else $state.go('dashboard');
            });
        }
    }]);

});