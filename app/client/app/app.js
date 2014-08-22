define([
    'angularCache',

    'sections/header/Header',
    'sections/navigation/Navigation',

    'global/translate/Translate',

    'pages/dashboard/dashboard',
    'pages/admin/admin',
    'pages/order/order',
    'pages/reports/report-page',
    'pages/autocomplete/AutoComplete',

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

            'app.pages.dashboard',
            'app.pages.admin',
            'app.pages.order',
            'app.pages.reports',
            'app.pages.autocomplete',

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
                        navigationView: {
                            template: 'navigationView init from Dashboard'
                        },
                        contentView: {
                            templateUrl: 'app/pages/dashboard/dashboard.html'
                        }
                    }
                }).state('admin', {
                    url: '/admin',
                    abstract: true,
                    views: {
                        navigationView: {
                            template: 'navigationView init from Admin'
                        },
                        contentView: {
                            templateUrl: 'app/pages/admin/admin.html'
                        }
                    }
                }).state('admin.start', {
                    url: '',
                    template: '<h2>Lista od site funcii ovde</h2>'
                }).state('admin.grid', {
                    url: '/grid/:gridName',
                    template: '<custom-grid check-fields-column="1" edit-id="{{editId}}" grid-data-url="test_api/testform.json"></custom-grid>',
                    controller: function ($scope, $stateParams) {
                        $scope.gridName = $stateParams.gridName;
                    }
                }).state('admin.grid.edit', {
                    url: '/edit/:id',
                    template: '<form custom-form form-id="{{id}}"></form>',
                    controller: function ($scope, $stateParams) {
                        $scope.id = $stateParams.id;
                    }
                }).state('admin.grid.add', {
                    url: '/add',
                    template: '<form custom-form ></form>'
                }).state('admin.order', {
                    url: '/order',
                    templateUrl: 'app/pages/order/order.html'
                }).state('admin.reports', {
                    url: '/reports',
                    templateUrl: 'app/pages/reports/report-page.html'
                }).state('admin.autocomplete', {
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