define([
    'angularCache',

    'sections/header/Header',
    'sections/navigation/Navigation',
    'sections/toaster/toaster-services',

    'global/translate/Translate',

    'pages/orders/orders',
    'pages/reports/report-page',
    'pages/autocomplete/AutoComplete',
    'pages/resources/resources',
    'pages/resources_retail/resources',
    'pages/calculations/calculations',

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
            'app.pages.autocomplete',
            'app.pages.resources',
            'app.pages.resources.retail',
            'app.pages.calculations',

            'app.forms.grid',
            'app.forms.summary',
            'app.forms.inputs.dependency',


            'app.reports'
        ])
        .config([
            '$stateProvider', '$urlRouterProvider', function ($stateProvider, $urlRouter) {
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
                    templateUrl:'app/pages/orders/orders.html'
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
                    templateUrl:'app/pages/reports/reports.html'
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
                            templateUrl: 'app/pages/finance/finance.html'
                        }
                    }
                }).state('retail.start', {
                    url: '',
                    templateUrl: 'app/pages/finance/finance.html'
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
                    templateUrl:'app/pages/calculations/calculations.html'
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

    return app;
});