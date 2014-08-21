/*
define([
], function () {
    var module = angular.module('app.data.github', [
        'angular-data.DSCacheFactory'
    ])

    module.service('githubService', function (DSCacheFactory, $http, $q) {
        var factory = {};

        var githubCache = DSCacheFactory('githubCache', {
            maxAge: 90000,
            cacheFlushInterval: 600000,
            deleteOnExpire: 'aggressive',

        });

        factory.getUserRepos = function (username) {
            var deferred = $q.defer(),
                start = new Date().getTime();

            $http.get('https://api.github.com/users/stefankorun/repos', {
                cache: DSCacheFactory.get('githubCache')
            }).success(function (data) {
                console.log('time taken for request: ' + (new Date().getTime() - start) + 'ms');
                deferred.resolve(data);
            });
            return deferred.promise;
        };
        factory.getDemoData = function () {
            return {
                wow: "much doge"
            }
        };

        return factory;
    })

    return module;
});*/
