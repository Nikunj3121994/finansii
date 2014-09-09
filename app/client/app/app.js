define([
    'angularCache',

    'sections/header/Header',
    'sections/navigation/Navigation',
    'sections/toaster/toaster-services',

    'global/translate/Translate',

    'pages/finance/orders/orders',
    'pages/finance/reports/report-page',
    'pages/finance/resources/resources',
    'pages/retail/resources/resources',
    'pages/retail/calculations/calculations',
    'pages/signin/signin',

    'forms/grid/grid',
    'forms/summary/summary',
    'forms/inputs/custom-dependency-input',

    'reports/reports'
], function () {
    var app = angular.module('app',
        [
            'angular-data.DSCacheFactory',
            'ui.router',

            'app.header',
            'app.navigation',
            'app.toaster',

            'app.global.translate',

            'app.pages.orders',
            'app.pages.reports',
            'app.pages.resources',
            'app.pages.resources.retail',
            'app.pages.calculations',
            'app.pages.login',

            'app.forms.grid',
            'app.forms.summary',
            'app.forms.inputs.dependency',


            'app.reports'
        ])
        .config([
            '$httpProvider','$stateProvider', '$urlRouterProvider', function ($httpProvider,$stateProvider, $urlRouter) {

                $httpProvider.interceptors.push('httpRequestInterceptor');
                $urlRouter.when('', '/dashboard');
                $urlRouter.otherwise('/dashboard');


                $stateProvider.state('dashboard', {
                    url: '/dashboard',
                    views: {
                        headerView: {
                            template: '<h3>Dashboard</h3>'
                        },
                        contentView: {
                            template:'<div>dashboard</div>'
                        }
                    }
                }).state('login', {
                    url: '/login',
                    views: {
                        headerView: {
                            template: '<div class="signin-header">Sign In</div>'
                        },
                        contentView: {
                            templateUrl:'app/pages/signin/signin.html',
                            controller:'loginController'
                        }
                    }
                }).state('finance', {
                    url: '/finance',
                    abstract: true,
                    views: {
                        headerView: {
                            template: '<div><div class="btn" ui-sref="finance.start"><i class="fa fa-angle-left"></i> </div> Finance</div>'
                        },
                        contentView: {
                            templateUrl: 'app/pages/finance/finance.html'
                        }
                    }
                }).state('finance.start', {
                    url: '',
                    templateUrl: 'app/pages/finance/finance.html'
                }).state('finance.resources',{
                    url:'/resources',
                    template:'<div resources-page></div>'
                }).state('finance.resources.resource',{
                    url:'/:resource',
                    template:'<custom-grid grid-resource="{{resource}}"></custom-grid>',

                    controller:function($scope,$stateParams){
                        $scope.resource=$stateParams.resource;
                    }
                }).state('finance.orders',{
                    url:'/orders',
                    templateUrl:'app/pages/finance/orders/orders.html'
                }).state('finance.orders.ledgers',{
                    url:'/:companyCode/:orderId',
                    template:'<custom-grid grid-resource="ledgers" grid-params="params"></custom-grid>',

                    controller:function($scope,$stateParams){
                        $scope.params={
                            order_id:$stateParams.orderId,
                            company_code:$stateParams.companyCode
                        };
                    }
                }).state('finance.reports',{
                    url:'/reports',
                    templateUrl:'app/pages/finance/reports/reports.html'
                }).state('404', {
                    url: '/404',
                    views: {
                        navigationView: {
                            template: 'navigationView init from signin'
                        },
                        contentView: {
                            template: '<h1>page doesnt exist</h1>'
                        }
                    }
                }).state('signin', {
                    url: '/signin',
                    views: {
                        navigationView: {
                            template: 'navigationView init from signin'
                        },
                        contentView: {
                            templateUrl: 'app/pages/user/signin.html'
                        }
                    }
                }).state('retail', {
                    url: '/retail',
                    abstract: true,
                    views: {
                        headerView: {
                            template: '<div><div class="btn" ui-sref="retail.start"><i class="fa fa-angle-left"></i> </div> Calculations</div>'
                        },
                        contentView: {
                            templateUrl: 'app/pages/retail/retail.html'
                        }
                    }
                }).state('retail.start', {
                    url: '',
                    templateUrl: 'app/pages/retail/retail.html'
                }).state('retail.resources',{
                    url:'/resources',
                    template:'<div resources-calculations-page></div>'
                }).state('retail.resources.resource',{
                    url:'/:resource',
                    template:'<custom-grid grid-resource="{{resource}}"></custom-grid>',

                    controller:function($scope,$stateParams){
                        $scope.resource=$stateParams.resource;
                    }
                }).state('retail.calculationHeader',{
                    url:'/calculations',
                    templateUrl:'app/pages/retail/calculations/calculations.html'
                }).state('retail.calculationHeader.calculations',{
                    url:'/:calculationHeaderId',
                    template:'<custom-grid grid-resource="calculation-details" grid-params="params"></custom-grid>',

                    controller:function($scope,$stateParams){
                        $scope.params={
                            calculation_header_id:$stateParams.calculationHeaderId
                        };
                    }
                });
            }
        ]).run(['$rootScope', 'DSCacheFactory', function ($rootScope) {

            // Maximize app on specific pages
            $rootScope.$on('$stateChangeSuccess',
                function (event, toState) {
                    var current = toState.url;
                    var specific = [
                        '/404',
                        '/signin'
                    ];
                    $rootScope.shouldMaximize = _.contains(specific, current);
                    $rootScope.currentUiState = toState;
                }
            );
        }]);
        app.factory('httpRequestInterceptor', function ($injector,$rootScope) {
            return {

                response:function(response){
                    if(response.data.code==405){
                        if($injector.get('$state').current.name!='login'){
                            $rootScope.previousStateParams= _.clone($injector.get('$stateParams'));
                            $rootScope.previousState= $injector.get('$state').current.name;
                            $injector.get('$state').go('login');
                        }
                        response.data={error:response.data};
                        return response;
                    }else {
                        return response;
                    }
                }
            };
        });

    return app;
});