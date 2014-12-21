var knex = require('../db/db.js');
var models = {
    bookshelf : require('bookshelf')(knex)
};
models.bookshelf = require('bookshelf')(knex);
module.exports = bookshelf;