/**
 * Created by kliment on 11/1/2014.
 */
define([],function(){
    var module=angular.module('app.services.config',[]).factory('configService',function(){
        var config={};
        config.resourseUrl="http://localhost:8080/finansii/api/public/";
        config.dateFormat="dd.mm.yyyy";
        config.loading="loading-animation2";
        return config;
    });
});