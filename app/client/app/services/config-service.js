/**
 * Created by kliment on 11/1/2014.
 */
define([],function(){
    var module=angular.module('app.services.config',[]).factory('configService',function(){
        var config={};
        config.resourseUrl="http://localhost/finansii/api/public/";
        config.dateFormat="dd.mm.yyyy";
        config.loading="none";
        return config;
    });
});