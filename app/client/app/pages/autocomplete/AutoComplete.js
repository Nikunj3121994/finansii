define([
    'forms/inputs/custom-auto-complete',
    'forms/inputs/input-services'
], function () {
    var module = angular.module('app.pages.autocomplete', [
        'app.forms.inputs.customAutoComplete',
        'app.forms.inputs.services'
    ]);
    module.controller('autoComplete',function($scope){

    });
    return module;
});