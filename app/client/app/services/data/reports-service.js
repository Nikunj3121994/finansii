define([], function () {
    var module = angular.module('app.services.data.reports', []);
    module.factory('reportService',['$q', '$http', 'toasterService', 'configService', function($q, $http,toasterService,configService){
        this.getReport=function(filters,report){
            $(configService.loading).fadeIn();
            var deferred = $q.defer(),
                start = new Date().getTime();
            var reportUrl=configService.resourseUrl+"reports/"+report;
            $http({
                url: reportUrl,
                params:filters,
                method: "GET"
            })
                .success(function (data) {
                    if(data.code)
                        if(data.code>0){
                            toasterService.setWarning(data.msg);
                        }else {
                            toasterService.setInfo(data.msg);
                        }
                    else{
                        if(data.error.code>0){
                            toasterService.setWarning(data.error.msg);
                        }else {
                            toasterService.setInfo(data.error.msg);
                        }
                    }
                    deferred.resolve(data);
                    $(configService.loading).fadeOut();
                })
                .error(function (data) {
                    toasterService.setError("Error getting resource");
                    deferred.reject("There was and error.");
                    $(configService.loading).fadeOut();
                });

            return deferred.promise;
        };
        this.generateGroupedData=function(data,config){
            if(!config.groups || !config.sums) return data;
            var dataTmp=[];
            var groups={};
            var sums={};
            for(var i=0;i<config.groups.length;i++){
                groups[config.groups[i].name]=null;
                sums[config.groups[i].name]={};
                for(var m=0;m<config.sums.length;m++){
                    sums[config.groups[i].name][config.sums[m].field]=0;
                }
            }
            for(var k=0;k<data.length;k++){
                for(var j=0;j<config.groups.length;j++){
                    var group=null;
                    if(config.groups[j].groupType=='number') group=Math.floor(data[k][config.groups[j].field]/Math.pow(10,config.groups[j].group));
                    else if(config.groups[j].groupType=='text') group=data[k][config.groups[j].field];
                    if(groups[config.groups[j].name]!=null){
                        var tmpRow={};
                        if(groups[config.groups[j].name]!=group){
                            var prefix=config.groups[j].groupPrefix || '';
                            var field=config.groups[j].fieldPosition || config.groups[j].field;
                            if(config.groups[j].type=='header'){
                                tmpRow[field]=prefix+groups[config.groups[j].name];
                            }else{
                                tmpRow[field]=prefix+groups[config.groups[j].name];
                                tmpRow.class=config.groups[j].name;
                                for(var n=0;n<config.sums.length;n++){
                                    tmpRow[config.sums[n].field]=sums[config.groups[j].name][config.sums[n].field].toFixed(2);
                                    // console.log(tmpRow[config.sums[n].field]=sums[config.groups[j].name],sums[config.groups[j].name][config.sums[n].field]);
                                    sums[config.groups[j].name][config.sums[n].field]=0;
                                }
                            }
                            dataTmp.push(tmpRow);
                            groups[config.groups[j].name]=group;
                        }
                    }else{
                        var tmpRow={};
                        groups[config.groups[j].name]=group
                        if(config.groups[j].type=='header'){
                            tmpRow[config.groups[j].fieldPosition]=groups[config.groups[j].name];
                            dataTmp.push(tmpRow);
                        }

                    }
                    for(var n=0;n<config.sums.length;n++){
                        sums[config.groups[j].name][config.sums[n].field]+=parseFloat(data[k][config.sums[n].field]);

                    }
                }
                dataTmp.push(data[k]);
            }
            for(var j=0;j<config.groups.length;j++){
                var prefix=config.groups[j].groupPrefix || '';
                var field=config.groups[j].fieldPosition || config.groups[j].field;
                if(config.groups[j].type=='header') continue;
                tmpRow={};
                tmpRow[field]=prefix+groups[config.groups[j].name];
                tmpRow.class=config.groups[j].name;
                for(var n=0;n<config.sums.length;n++){
                    tmpRow[config.sums[n].field]=sums[config.groups[j].name][config.sums[n].field].toFixed(2);
                }
                dataTmp.push(tmpRow);
            }

            return dataTmp;
        };
        this.getFinanceConfig=function(){
            return [
                {
                    name: 'accounts',
                    label: 'Accounts Report',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'document_desc', label: 'Description',format:'text'},
                        {name: 'document_number', label: "Number",format:'text'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'account',
                            group: 3,
                            groupType:'number'
                        },
                        {
                            field: 'account',
                            name: 'class',
                            group: 5,
                            groupType:'number'
                        },
                        {
                            field: 'order_number',
                            name: 'order',
                            group: 0,
                            type:'header',
                            groupType:'text',
                            fieldPosition:'account'
                        }
                    ],
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                } ,
                {
                    name: 'main-book',
                    label: 'Main book',
                    fields: [
                        {name: 'order_number', label: "Order number",format:'text'},
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'document_desc', label: 'Description',format:'text'},
                        {name: 'document_number', label: "Number",format:'text'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'account',
                            group: 0,
                            groupType:'number'
                        }
                    ],
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                },
                {
                    name: 'accounts',
                    label: 'Analytic card',
                    fields: [
                        {name: 'order_number', label: "Order number",format:'text'},
                        {name: 'document_date', label: "Date",format:'text'},
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'document_desc', label: 'Description',format:'text'},
                        {name: 'document_number', label: "Number",format:'text'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'class',
                            group: 0,
                            groupType:'number',
                            fieldPosition:'order_number'
                        }
                    ],
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                } ,
                {
                    name: 'gross-balance-synthetics',
                    label: 'Gross balance synthetics',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'start_owes', label: 'Start owes'},
                        {name: 'start_asks', label: 'Start Asks'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'},
                        {name:'total_owes',label:'Total owes'},
                        {name:'total_asks',label:'Total asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'account',
                            group: 2,
                            groupType:'number'
                        }
                    ],
                    sums: [
                        {
                            field: 'start_owes'
                        },
                        {
                            field: 'start_asks'
                        },
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field:'total_asks'
                        },
                        {
                            field:'total_owes'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                },{
                    name: 'gross-balance-analytics',
                    label: 'Gross balance analytics',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name:'group1',label:"Group 1",type:"group",
                            fields:[
                                {name: 'owes', label: 'Owes'},
                                {name: 'asks', label: 'Asks'}
                            ]
                        },
                        {name:'total',label:'Total'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'account',
                            group: 3,
                            groupType:'number'
                        },
                        {
                            field: 'account',
                            name: 'class',
                            group: 5,
                            groupType:'number',
                            groupPrefix:'Class'
                        },
                        {
                            field: 'account',
                            name: 'total',
                            group: 6,
                            groupType:'number',
                            groupPrefix:'Total'
                        }
                    ],
                    headerSettings:{
                        levels:2
                    },
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field: 'total'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                },{
                    name: 'gross-balance-synthetics',
                    label: 'Finished sheet',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'start_owes', label: 'Start Owes'},
                        {name: 'start_asks', label: 'Start Asks'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'},
                        {name:'total_owes',label:'Total owes'} ,
                        {name:'total_asks',label:'Total asks'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'group',
                            group: 1,
                            groupType:'number',
                            groupPrefix:'G.'
                        },{
                            field: 'account',
                            name: 'class',
                            group: 2,
                            groupType:'number',
                            groupPrefix:'C.'
                        },
                        {
                            field: 'account',
                            name: 'total',
                            group: 3,
                            groupType:'number',
                            groupPrefix:'Total'
                        }
                    ],
                    sums: [
                        {
                            field: 'start_owes'
                        },
                        {
                            field: 'start_asks'
                        },
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field: 'total_owes'
                        },
                        {
                            field: 'total_asks'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                },{
                    name: 'account-specification',
                    label: 'Account specification',
                    fields: [
                        {name: 'account', label: "Account",format:'text'},
                        {name: 'account_name', label: "Account Name",format:'text'},
                        {name: 'owes', label: 'Owes'},
                        {name: 'asks', label: 'Asks'},
                        {name:'total',label:'Total'}
                    ],
                    groups: [
                        {
                            field: 'account',
                            name: 'total',
                            group: 6,
                            groupType:'number',
                            groupPrefix:'Total'
                        }
                    ],
                    sums: [
                        {
                            field: 'owes'
                        },
                        {
                            field: 'asks'
                        },
                        {
                            field: 'total'
                        }
                    ],
                    filters: ['orderFrom', 'orderTo', 'dateFrom', 'dateTo'],
                    filtersConfig: {
                        orderFrom: {
                            label: 'Orders from'
                        },
                        orderTo: {
                            label: 'Order to'
                        },
                        dateFrom: {
                            label: 'Date from'
                        },
                        dateTo: {
                            label: 'Date to'
                        }
                    }
                }
            ];
        };
        return this;
    }]);

    return module;
});