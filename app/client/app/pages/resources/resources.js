define([], function() {

        var module=angular.module('app.pages.resources',[]);

        module.controller('resourcesPageController',function(){

        })
        module.directive('resourcesPage',function(){
            function link($scope){
                    $scope.resources=[{
                        name:'Места',
                        resource:'settlements'
                    },{
                        name:'Општини',
                        resource:'municipalities'
                    }]
            }
            return {
                restrict:'EA',
                link:link,
                templateUrl:"app/pages/resources/resources.html"
            }
        });


        return module;
});