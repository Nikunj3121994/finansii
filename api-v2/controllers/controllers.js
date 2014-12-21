var controllerGroups = {
   trade:require('./trade/controllers-trade')
};
var controllers = {};
controllers.getController = function(name,moduleName){
    return require('./'+moduleName+'/'+controllerGroups[moduleName][name]);
};
module.exports = controllers;