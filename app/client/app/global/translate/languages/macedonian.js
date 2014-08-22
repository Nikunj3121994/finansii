define([], function() {
    var module = angular.module('app.global.translate.macedonian', []);

    module.constant('macedonianDictionary', {
        'WOW': 'WOW-македонски',
        'Dashboard': 'Почетна',
        'Admin': 'Администратор',
        'Admin module': 'Администраторски модул',
        'Financial module': 'Финансиски модул',
        'Storage module': 'Материјален модул'
    });

    return module;
});