define([], function() {

        var module=angular.module('app.pages.retail.resources',[]);
        module.run(function(navigationService){
            var state={
                label:'Resources',
                name:'retail.resources',
                parent:'retail.start'
            }
            navigationService.addState(state,state.name,state.parent);
            state={
                label:'Resources',
                name:'retail.resources.resource',
                parent:'retail.start'
            }
            navigationService.addState(state,state.name,state.parent);
        });
        module.controller('resourcesCalculationsPageController',function($scope){
            $scope.selectedResource=-1;
        })
        module.directive('resourcesCalculationsPage',function(){
            function link($scope){
                    $scope.resources=[{
                        name:'Companies',
                        resource:'companies'
                    },{
                        name:'Tariffs',
                        resource:'tariffs'
                    },{
                        name:'Units',
                        resource:'units'
                    },{
                        name:'Articles',
                        resource:'articles'
                    },{
                        name:'Calculation types',
                        resource:'calculation_types'
                    },{
                        name:'Business units',
                        resource:'business_units'
                    },{
                        name:'Partners',
                        resource:'partners'
                     },{
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

                    }]
            }
            return {
                restrict:'EA',
                link:link,
                templateUrl:"app/pages/retail/resources/resources.html"
            }
        });


        return module;
});