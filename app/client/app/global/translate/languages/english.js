define([], function() {
    var module = angular.module('app.global.translate.english', [])

    module.constant('englishDictionary', {
        'WOW': 'WOW-english'
    });

    return module;
});