define([],function(){
   return angular.module('app.services.ui.loading',[]).factory('loadingService',['configService', function(configService){
       var loading={};
       loading.show=function(){
           $('.'+configService.loading).show();
       };
       loading.hide=function(){
           $('.'+configService.loading).hide();
       };
       return loading;
   }]);
});