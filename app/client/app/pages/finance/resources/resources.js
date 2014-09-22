define([], function() {

        var module=angular.module('app.pages.finance.resources',[]);
        module.run(function(navigationService){
            var state={
                label:'Resources',
                name:'finance.resources',
                parent:'finance.start'
            }
            navigationService.addState(state,state.name,state.parent);
        });
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
                        resource:'sub_accounts'
                    },{
                        name:'Конта',
                        resource:'accounts'
                    },{
                        name:'Курс',
                        resource:'currencies'
                    },{
                        name:'Курсни листи',
                        resource:'exchange_rates'
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