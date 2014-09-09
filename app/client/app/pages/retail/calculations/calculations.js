define([], function () {

    var module = angular.module('app.pages.calculations', []);

    module.controller('calculationsController',function ($scope, calculationService,$state,$filter) {
        $scope.defaultOptions = {
            permissions: {
                search: true,
                select: 'multiple',
                filterColumns: false,
                addResource: false,
                editResource: false,
                deleteResource: true,
                formInline: true
            },
            formName: "default-name",
            pageSize: 10

        };
        $scope.calculationHeaderData={};
        $scope.saveData = function () {
            var calculationData={};
            calculationData.business_unit_id=$scope.calculationHeaderData.businessUnits.id;
            calculationData.partner_code=$scope.calculationHeaderData.partners.partner_code;
            calculationData.currency_code=$scope.calculationHeaderData.currencies.id;
            calculationData.calculation_type_code=$scope.calculationHeaderData.calculationTypes.calculation_type_code;
            calculationData.calculation_number=$scope.calculationHeaderData.calculation_number;
            calculationData.document_number=$scope.calculationHeaderData.document_number;
            calculationData.currency_value=$scope.calculationHeaderData.currency_value;
            calculationData.calculation_date=$filter('date')($scope.calculationHeaderData.calculation_date,"yyyy-MM-dd HH:mm:ss");
            calculationData.calculation_ddo=$filter('date')($scope.calculationHeaderData.calculation_ddo,"yyyy-MM-dd HH:mm:ss");
            calculationData.calculation_booked=$filter('date')($scope.calculationHeaderData.calculation_booked,"yyyy-MM-dd HH:mm:ss");
            calculationData.company_code=$scope.calculationHeaderData;
            if($scope.orderId!=null){
                calculationService.editCalculation(calculationData,$scope.calculationId).then(function(data){
                    $scope.currentCalculationHeader= $scope.calculationHeaderData;
                });
            } else calculationService.saveCalculation(calculationData).then(function(data){
                    $scope.calculations.unshift($scope.calculationHeaderData);
                    $state.go('retail.calculationHeader.calculations',{calculationHeaderId:data.id});

                });
        };
        $scope.$watch('currentCalculationHeader',function(){
            if(_.isUndefined($scope.currentCalculationHeader)) return;
            $scope.calculationHeaderData= $scope.currentCalculationHeader;
            $scope.calculationHeaderId=$scope.currentCalculationHeader.id;
            $state.go('retail.calculationHeader.calculations',{calculationHeaderId:$scope.calculationHeaderData.id});
        });
        function findResourceById(id){
           for(var i=0;i<$scope.calculations.length;i++){
               if($scope.calculations[i].id==id) { return $scope.calculations[i];}
           }
           return null;
        }
        if($state.params.calculationHeaderId){
            $scope.$watch('calculations',function(){
                if(_.isUndefined($scope.calculations)) return;
                $scope.calculationHeaderData=findResourceById($state.params.calculationHeaderId);
                $scope.calculationID=$scope.calculationHeaderData.id;
            });

        }
        $scope.newCalculation=function(){
            $state.go('retail.calculation');
            $scope.calculationHeaderData={};
            $scope.calculationHeaderId=null;
        }


    }).factory('calculationService', ["$q", "$http" , function ($q, $http) {
            this.saveCalculation = function (data) {
                var deferred = $q.defer();

                var url = "http://localhost/finansii/api/public/calculation-headers";
                $http({
                    url: url,
                    data: data,
                    method: "POST"
                })
                    .success(function (data) {
                        if (data.code) deferred.resolve(data);
                        else deferred.resolve(data.body);



                    })
                    .error(function (data) {
                        console.log("Error getting testform.json");
                        deferred.reject("There was and error.");
                    });

                return deferred.promise;
            };
            this.editCalculation = function (data,id) {
                var deferred = $q.defer();

                var url = "http://localhost/finansii/api/public/calculation-headers/"+id;
                $http({
                    url: url,
                    data: data,
                    method: "PUT"
                })
                    .success(function (data) {
                        if (data.code) deferred.resolve(data);
                        else deferred.resolve(data.body);



                    })
                    .error(function (data) {
                        console.log("Error getting testform.json");
                        deferred.reject("There was and error.");
                    });

                return deferred.promise;
            };
            return this;
        }]);
});
