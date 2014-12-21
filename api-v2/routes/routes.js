var defaultRoutes = {
    get: [
        {
            route: '',
            func: 'getAll'
        },
        {
            route: '/:id',
            func: 'getOne'
        }
    ],
    post: [
        {
            route: '',
            func: 'save'
        }
    ],
    patch: [
        {
            route: '/:id',
            func: 'update'
        }
    ]
};
var _ = require('lodash');
var controllers = require('../controllers/controllers.js');

var businessModules = {
    trade: require('./trade/routes-trade.js')
};

function bindRoutes(app, subRoutes, method, controller, parentRoute) {
    _(subRoutes).each(function (subRoute) {
        app[method]('/' + parentRoute + subRoute.route, controller[subRoute.func]);
    });
}

var routes = {};

routes.generateRoutes = function (app,moduleName) {
    _(businessModules[moduleName]).each(function (route) {
        var allRoutes = route.routes || defaultRoutes;
        _(allRoutes).each(function (subRoutes, method) {
            var controller = controllers.getController(route.controller, 'trade');
            bindRoutes(app, subRoutes, method, controller, route.name);
        })
    });
};
module.exports = routes;