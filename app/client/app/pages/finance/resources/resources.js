define([], function() {

        var module=angular.module('app.pages.resources',[]);

        module.controller('resourcesPageController',function($scope){
            $scope.selectedResource=-1;
        })
        module.directive('resourcesPage',function(){
            function link($scope){
                    $scope.resources=[{
                        name:'Места',
                        resource:'settlements'
                    },{
                        name:'Општини',
                        resource:'municipalities'
                    },{
                        name:'Улици',
                        resource:'streets'
                    },{
                        name:'Банки',
                        resource:'banks'
                    },{
                        name:'Оператори',
                        resource:'operators'
                    },{
                        name:'Компании',
                        resource:'companies'
                    },{
                        name:'Под конта',
                        resource:'sub-accounts'
                    },{
                        name:'Конта',
                        resource:'accounts'
                    },{
                        name:'Курс',
                        resource:'currencies'
                    },{
                        name:'Курсни листи',
                        resource:'exchange-rates'
                    }]
            }
            return {
                restrict:'EA',
                link:link,
                templateUrl:"app/pages/finance/resources/resources.html"
            }
        });


        return module;
});