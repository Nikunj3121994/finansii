define([
    'services/ui/navigation-service',
    'services/config-service',
    'services/data/resource-service',
    'services/data/autocomplete-service',
    'services/data/summary-service'
],function(){
    return angular.module('app.services',[
        'app.services.ui.navigation',
        'app.services.config',
        'app.services.data.resources',
        'app.services.autocomplete',
        'app.services.summary'
    ]);
});
