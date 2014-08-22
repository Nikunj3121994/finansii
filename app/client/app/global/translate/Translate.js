define([
    'global/translate/languages/english',
    'global/translate/languages/macedonian'
], function () {
    var module = angular.module('app.global.translate', [
        'pascalprecht.translate',
        'app.global.translate.english',
        'app.global.translate.macedonian'
    ])

    module.config(['$translateProvider', 'englishDictionary', 'macedonianDictionary',
        function ($translateProvider, englishDictionary, macedonianDictionary) {

            $translateProvider.translations('en', englishDictionary);

            $translateProvider.translations('mk', macedonianDictionary);

            $translateProvider.preferredLanguage('mk');

        }]);

    return module;
});