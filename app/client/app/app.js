define([
    'angularCache',

    'sections/header/Header',
    'sections/toaster/toaster-services',

    'global/translate/Translate',

    'pages/dashboard/dashboard',
    'pages/finance/finance',
    'pages/finance/orders/orders',
    'pages/finance/reports/report-page',
    'pages/finance/resources/resources',
    'pages/retail/retail',
    'pages/retail/calculations/calculations',
    'pages/retail/reports/report-page',
    'pages/retail/resources/resources',
    'pages/signin/signin',
    'pages/signup/signup',

    'forms/grid/grid',
    'forms/summary/summary',
    'forms/inputs/custom-dependency-input',
    'forms/inputs/custom-dropdown',

    'reports/reports',

    'services/services'
], function () {
    var app = angular.module('app',
        [
            'angular-data.DSCacheFactory',
            'ui.router',

            'app.sections.header',
            'app.sections.toaster',

            'app.global.translate',

            'app.pages.dashboard',
            'app.pages.finance',
            'app.pages.finance.orders',
            'app.pages.finance.reports',
            'app.pages.finance.resources',

            'app.pages.retail',
            'app.pages.retail.calculations',
            'app.pages.retail.reports',
            'app.pages.retail.resources',
            'app.pages.login',
            'app.pages.register',

            'app.forms.grid',
            'app.forms.summary',
            'app.forms.inputs.dependency',
            'app.forms.inputs.dropdown',


            'app.reports',

            'app.services'

        ])
        .config([
            '$httpProvider','$stateProvider', '$urlRouterProvider','uiSelectConfig', function ($httpProvider,$stateProvider, $urlRouter,uiSelectConfig) {


                uiSelectConfig.theme = 'selectize';

                $httpProvider.interceptors.push('httpRequestInterceptor');
                $urlRouter.when('', '/dashboard');
                $urlRouter.otherwise('/dashboard');


                $stateProvider.state('dashboard', {
                    url: '/dashboard',
                    views: {
                        headerView: {
                            template: '<div data-custom-header></div>'
                        },
                        contentView: {
                            templateUrl:'app/pages/dashboard/dashboard.html'
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
                }).state('register', {
                    url: '/register',
                    views: {
                        headerView: {
                            template: '<div class="signin-header">Sign Up</div>'
                        },
                        contentView: {
                            templateUrl:'app/pages/signup/signup.html',
                            controller:'registerController'
                        }
                    }
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
                })
            }
        ]).run(['$http', function ($http) {
            var token=localStorage.getItem('token');
            if(token) {
                $http.defaults.headers.common['X-Auth-Token']=token;
            }

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