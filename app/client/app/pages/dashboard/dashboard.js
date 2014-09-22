define([], function () {
    var module = angular.module('app.pages.dashboard', []);
    module.run(function(navigationService){
        var state={
            label:'Dashboard',
            name:'dashboard',
            parent:null
        }
        navigationService.addState(state,state.name,state.parent);
    });
    return module;
});