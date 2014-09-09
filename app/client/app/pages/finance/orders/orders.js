define([], function () {

    var module = angular.module('app.pages.orders', []);

    module.controller('ordersController',function ($scope, ordersService,$state,$filter) {
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
        $scope.orderData={};
        $scope.saveData = function () {
            var orderData={};
            orderData.order_type=$scope.orderData.order_type;
            orderData.order_number=$scope.orderData.order_number;
            orderData.order_date=$filter('date')($scope.orderData.order_date,"yyyy-MM-dd HH:mm:ss");
            orderData.company_code=$scope.orderData.companies.company_code;
            if($scope.orderId!=null){
                ordersService.editOrder(orderData,$scope.orderId).then(function(data){
                    $scope.currentOrder= $scope.orderData;
                });
            } else ordersService.saveOrder(orderData).then(function(data){
                    $scope.orders.unshift($scope.orderData);
                    $state.go('finance.orders.ledgers',{orderId:data.id,companyCode:$scope.orderData.companies.company_code});

                });
        }
        $scope.$watch('currentOrder',function(){
            if(_.isUndefined($scope.currentOrder)) return;
            $scope.orderData= $scope.currentOrder;
            $scope.orderId=$scope.orderData.id;
            $state.go('finance.orders.ledgers',{orderId:$scope.orderData.id,companyCode:$scope.orderData.companies.company_code});
        });
        function findResourceById(id){
           for(var i=0;i<$scope.orders.length;i++){
               if($scope.orders[i].id==id) { return $scope.orders[i];}
           }
           return null;
        }
        if($state.params.orderId){
            $scope.$watch('orders',function(){
                if(_.isUndefined($scope.orders)) return;
                $scope.orderData=findResourceById($state.params.orderId);
                $scope.orderId=$scope.orderData.id;
            });

        }
        $scope.newOrder=function(){
            $state.go('finance.orders');
            $scope.orderData={};
            $scope.orderId=null;
        }
        $scope.archiveOrder=function(){
            ordersService.archiveOrder($scope.orderData.id,$scope.orderData.companies.company_code).then(function(data){
               if(data.code==0){
                   $scope.orderData={};
                   $state.go('finance.orders');
               } else{
                   alert(data.toString());
               }
            });
        }

    }).factory('ordersService', ["$q", "$http" , function ($q, $http) {
            this.saveOrder = function (data) {
                var deferred = $q.defer();

                var url = "http://localhost/finansii/api/public/orders";
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
            this.editOrder = function (data,id) {
                var deferred = $q.defer();

                var url = "http://localhost/finansii/api/public/orders/"+id;
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
            this.archiveOrder = function (orderId,companyCode) {
                var deferred = $q.defer();

                var url = "http://localhost/finansii/api/public/archive-ledgers";
                $http({
                    url: url,
                    data: {orderId:orderId,companyCode:companyCode},
                    method: "POST"
                })
                    .success(function (data) {
                        deferred.resolve(data);
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
