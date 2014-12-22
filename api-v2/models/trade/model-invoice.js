var bookshelf = require('../models').bookshelf;
var uuid = require('node-uuid');
var invoice = bookshelf.Model.extend({
    tableName: 'invoice',
    defaults: function(){
        var body = {};
        body.id = uuid.v4();
        body.created_at = new Date();
        body.updated_at = new Date();
        return body;
    }

});
module.exports = invoice;