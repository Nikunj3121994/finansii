define([], function() {
    var module = angular.module('app.sections.header.controllers', []);

    module.controller('headerController',function ($scope,$rootScope,$state,navigationService,loginService) {
            $scope.state=navigationService.findState($state.current.name,navigationService.path);
            if($scope.state.parent!=null){
                $scope.parent=navigationService.findState($scope.state.parent,navigationService.path);
            }
            $rootScope.$on('$stateChangeStart', function(e, toState, toParams, fromState, fromParams) {
                $scope.state=navigationService.findState(toState.name,navigationService.path);
                if($scope.state.parent!=null){
                    $scope.parent=navigationService.findState($scope.state.parent,navigationService.path);
                }
            });
            $scope.navigate=function(parent){
                $state.go(parent);
            };
            $scope.logout=function(){
                loginService.logout().then(function(data){
                   $state.go('login');
                });
            };

    });
    module.directive('customHeader', function () {
        return {
            restrict: 'EA',
            controller: 'headerController',
            templateUrl: 'app/sections/header/views/header.html'
        }
    });

    return module;
});