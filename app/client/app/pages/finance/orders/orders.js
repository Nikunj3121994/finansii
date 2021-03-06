define([], function () {

    var module = angular.module('app.pages.finance.orders', []);
    module.run(['navigationService', function(navigationService){
        var state={
            label:'Orders',
            name:'finance.orders',
            parent:'finance.start'
        };
        navigationService.addState(state,state.name,state.parent);
        state={
            label:'Order edit',
            name:'finance.orders.ledgers',
            parent:'finance.orders'
        };
        navigationService.addState(state,state.name,state.parent);
    }]);
    module.controller('ordersController',['$scope', 'ordersService', '$state', '$filter', 'toasterService', function ($scope, ordersService,$state,$filter,toasterService) {
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
        };
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
        function removeResourceById(id){
            console.log(id);
            for(var i=0;i<$scope.orders.length;i++){
                if($scope.orders[i].id==id) {console.log('sdfdsf'); $scope.orders.splice(i,1); return null;}
            }
            return null;
        }
        if($state.params.orderId){
            $scope.$watch('orders',function(){
                if(_.isUndefined($scope.orders)) return;
                $scope.currentOrder=findResourceById($state.params.orderId);

            });

        }
        $scope.newOrder=function(){
            $state.go('finance.orders');
            $scope.orderData={};
            $scope.orderId=null;
        };
        $scope.archiveOrder=function(){
            ordersService.archiveOrder($scope.orderData.id,$scope.orderData.companies.company_code).then(function(data){
               if(data.code==0){
                   $scope.orderData={};
                   $scope.currentOrder=undefined;
                   removeResourceById($scope.orderId);
                   $scope.orderId=null;
                   $state.go('finance.orders');
               } else{
                   toasterService.setError(data.msg);
               }
            });
        }

    }])
});
