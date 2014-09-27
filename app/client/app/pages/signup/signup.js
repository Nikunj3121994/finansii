define([], function () {

    var module = angular.module('app.pages.register', []);
    module.run(function (navigationService) {
        var state = {
            label: 'Sign Up',
            name: 'register',
            parent: null
        }
        navigationService.addState(state, state.name, state.parent);
    });
    module.controller('registerController', function ($scope, registerService, $http, $state, $rootScope) {
        $scope.registerModel={};
        $scope.register = function () {
            registerService.register($scope.registerModel).then(function (data) {
                $state.go('dashboard');
            });
        }
    });
    module.factory('registerService', function (toasterService, $q, $http) {
        this.register = function (data) {
            $('.loading-animation').fadeIn();
            var deferred = $q.defer();
            var url = "http://localhost/finansii/api/public/admin";
            $http({
                url: url,
                data: data,
                method: "POST"
            })
                .success(function (data) {
                    if (data.code != 0) {
                        toasterService.setWarning(data.msg);
                        deferred.reject(data);
                    } else {
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