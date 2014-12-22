var knex = require('../db/db.js');
var models = {
    bookshelf: require('bookshelf')(knex)
};
models.modules = {
    trade: require('./trade/models-trade.js')
};
models.bookshelf = require('bookshelf')(knex);
models.getModel = function (name, moduleName) {
    return models.modules[moduleName][name];
};
module.exports = models;