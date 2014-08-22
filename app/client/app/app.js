define([
    'angularCache',

    'sections/header/Header',
    'sections/navigation/Navigation',

    'global/translate/Translate',

    'pages/order/order',
    'pages/reports/report-page',
    'pages/autocomplete/AutoComplete',
    'pages/resources/resources',

    'forms/grid/grid',
    'forms/summary/summary',

    'reports/reports'
], function () {
    var app = angular.module('app',
        [
            'angular-data.DSCacheFactory',
            'ui.router',

            'app.header',
            'app.navigation',

            'app.global.translate',

            'app.pages.order',
            'app.pages.reports',
            'app.pages.autocomplete',
            'app.pages.resources',

            'app.forms.grid',
            'app.forms.summary',

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
                            template:'dashboard'
                        }
                    }
                }).state('finance', {
                    url: '/finance',
                    abstract: true,
                    views: {
                        headerView: {
                            template: '<h3><div class="btn" ui-sref="dashboard"><i class="glyphicon glyphicon-chevron-left"></i> </div> Finance</h3>'
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
                    url:'/resources/:resource',
                    template:'<custom-grid grid-data="ordersData" grid-resource="{{resource}}" grid-data-url="test_api/testnalog.json" grid-options="smallGridOptions"></custom-grid>',

                    controller:function($scope,$stateParams){
                        $scope.resource=$stateParams.resource;
                    }
                }).state('admin.grid', {
                    url: '/grid/:gridName',
                    template: '<custom-grid check-fields-column="1" edit-id="{{editId}}" grid-data-url="test_api/testform.json"></custom-grid>',
                    controller: function ($scope, $stateParams) {
                        $scope.gridName = $stateParams.gridName;
                    }
                }).state('finance.reports', {
                    url: '/reports',
                    templateUrl: 'app/pages/reports/report-page.html'
                }).state('finance.autocomplete', {
                    url: '/autocomplete',
                    templateUrl: 'app/pages/autocomplete/auto-complete.html'
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