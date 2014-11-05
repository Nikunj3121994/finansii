define([], function() {

        var module=angular.module('app.pages.finance.resources',['ngMaterial']);
        module.run(function(navigationService){
            var state={
                label:'Resources',
                name:'finance.resources',
                parent:'finance.start'
            };
            navigationService.addState(state,state.name,state.parent);
            state={
                label:'Resources',
                name:'finance.resources.resource',
                parent:'finance.start'
            };
            navigationService.addState(state,state.name,state.parent);
        });
        module.controller('resourcesPageController',function($scope){
            $scope.selectedResource=-1;
        });
        module.directive('resourcesPage',function(){
            function link($scope){
                    $scope.resources=[{
                        name:'Settlements',
                        resource:'settlements'
                    },{
                        name:'Municipalities',
                        resource:'municipalities'
                    },{
                        name:'Streets',
                        resource:'streets'
                    },{
                        name:'Banks',
                        resource:'banks'
                    },{
                        name:'Companies',
                        resource:'companies'
                    },{
                        name:'Sub accounts',
                        resource:'sub_accounts'
                    },{
                        name:'Accounts',
                        resource:'accounts'
                    },{
                        name:'Currencies',
                        resource:'currencies'
                    },{
                        name:'Exchange rates',
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