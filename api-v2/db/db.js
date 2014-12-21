var connectionString = {
    client: 'pg',
    connection: {
        host     : '127.0.0.1',
        post     : '5432',
        user     : 'postgres',
        password : 'kliment',
        database : 'finance'
    }
};
var knex = require('knex')(connectionString);
module.exports = knex;