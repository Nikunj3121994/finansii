define([], function() {
    var module = angular.module("app.forms.summary.services", []);
    module.factory('summaryService',function(){
        var formulas = {};
        formulas.extractKey=function(obj,key){
            for(key1 in obj){
                if(key1==key){
                    return obj[key1];
                }
                if(_.isObject(obj[key1])){
                    var val=formulas.extractKey(obj[key1],key);
                    if(val!=null) return val;
                }
            }
            return null;
        };
        formulas.sumColumn = function (args,data) {
            /*expectedObject
             {
             column:\d+,
             range:{
             from:\d+,
             to:\d+
             }
             }
             */
            if (typeof args.column == "undefined") return 'Undefined column';
            var column = args.column;
            if (typeof $scope.data == "undefined") return 'Data not ready';
            var dataRange = {};
            if (args.range == null) {
                dataRange.from = 0;
                dataRange.to = $scope.data.length;
            } else {
                dataRange.from = args.range.from;
                dataRange.to = args.range.to;
            }
            var sum = 0;
            for (var i = dataRange.from; i < dataRange.to; i++) {
                sum += parseInt(data[i][column]) || 0;
            }
            return sum;
        };
        formulas.diffColumns = function (args,data) {
            /*expectedObject
             {
             column1:\d+,
             column2:\d+
             }
             */
            if (_.isUndefined(args.column1)) return 'Undefined column1';
            if (_.isUndefined(args.column1)) return 'Undefined column2';
            return this.sumColumn(args.column1,data) - this.sumColumn(args.column2,data);
        };
        formulas.diff = function (args,data) {
            return args.val1 - args.val2;
        };
        formulas.diffKeys = function (args,data) {
            return formulas.extractKey(data,args.val1) - formulas.extractKey(data,args.val2);
        };
        formulas.mul = function (args,data) {
            var val1=parseFloat(formulas.extractKey(data,args.val1));
            var val2=parseFloat(formulas.extractKey(data,args.val2));
            if(_.isNaN(val1)) return '';
            if(_.isNaN(val2)) return Math.round(val1*1000000)/1000000;
            return Math.round((val1 * val2)*1000000)/1000000;
        };
        formulas.divSameVal = function(args,data){
            var val1=parseFloat(formulas.extractKey(data,args.val1));
            var val2=parseFloat(formulas.extractKey(data,args.val2));

            if(_.isNaN(val1)) return '';
            if(_.isNaN(val2)) return Math.round(val1*1000000)/1000000;;
            return Math.round((val1/val2)*1000000)/1000000;
        }
        formulas.calculate = function callculate(args,data) {

            var formula = args.formula;
            var funcArgs = _.clone(args.funcArgs);
            for (var key in args.funcArgs) {
                if (key == 'properties') continue;
                if (_.has(args.funcArgs[key], 'formula')) {
                    funcArgs[key] = formulas.calculate(args.funcArgs[key],data);
                }
            }

            return formulas[formula](funcArgs,data);
        };
        return formulas;
    });


    return module;
});