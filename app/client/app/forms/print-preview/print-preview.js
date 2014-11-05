define([
    'forms/print-preview/print-preview-directives',
    'forms/print-preview/print-preview-controllers'
],function(){
    return angular.module('app.components.print.preview',[
        'app.components.print.preview.directives',
        'app.components.print.preview.controllers'
    ]);
});