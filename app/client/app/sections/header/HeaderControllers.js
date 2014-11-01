define([], function() {
    var module = angular.module('app.sections.header.controllers', []);

    module.controller('headerController',function ($scope,$rootScope,$state,navigationService,authService,$translate) {
        $scope.languages={
            'mk':{
            name:'MK',
            label:'Македонски',
            i18n:'mk'
            },
            'en':{
            name:'EN',
            label:'English',
            i18n:'en'
        }};
        var language=localStorage.getItem('language')
        if(_.isNull(language)) $scope.selectedlanguage=$scope.languages['mk'];
        else $scope.selectedlanguage=$scope.languages[language];
        $translate.use($scope.selectedlanguage.i18n);
        $scope.setLanguage=function(language){
            $scope.selectedlanguage=language;
            $translate.use(language.i18n);
            localStorage.setItem('language',language.i18n);
        };

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
            authService.logout().then(function(data){
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