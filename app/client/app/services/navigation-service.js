define([], function () {

    var module = angular.module('app.services.navigation', []);
    module.factory('navigationService',function(){
        var navigation={};
        navigation.path={};
        navigation.addState=function(state,stateName,parentName){
            if(parentName==null) {navigation.path[stateName]=state; return;}
            var parent=navigation.findState(parentName,navigation.path);
            parent[stateName]=state;
        };
        navigation.findState=function(stateName,object){
            for(var key in object){
                if(_.isObject(object[key])){

                    if(key==stateName) return object[key];
                    var result=navigation.findState(stateName,object[key]);
                    if(!_.isNull(result)) return result;
                }
            }
            return null;
        }
        return navigation;
    });
});