define([], function () {

    var module = angular.module('app.pages.orders', []);

    module.controller('ordersController',function ($scope, ordersService,$state) {
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
            pageSize: 15

        };
        $scope.orderData={};
        $scope.saveData = function () {
            var orderData={};
            orderData.order_type=$scope.orderData.order_type;
            orderData.order_number=$scope.orderData.order_number;
            orderData.order_date=$scope.orderData.order_date;
            orderData.operator_id=$scope.orderData.operators.id;
            if($scope.orderId!=null){
                ordersService.editOrder(orderData,$scope.orderId).then(function(data){
                    $scope.currentOrder= _.clone($scope.orderData);
                });
            } else ordersService.saveOrder(orderData).then(function(data){
                    $state.go('finance.orders.ledgers',{orderId:data.id});
                    $scope.orders.unshift($scope.orderData);
                });
        }
        $scope.$watch('currentOrder',function(){
            if(_.isUndefined($scope.currentOrder)) return;
            $scope.orderData= _.clone($scope.currentOrder);
            $scope.orderId=$scope.orderData.id;
            $state.go('finance.orders.ledgers',{orderId:$scope.orderData.id});
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
                console.log($scope.orderData);
            });

        }
        $scope.newOrder=function(){
            $state.go('finance.orders');
            $scope.orderData={};
            $scope.orderId=null;
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
            return this;
        }]);
});
