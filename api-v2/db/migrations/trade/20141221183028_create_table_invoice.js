'use strict';

exports.up = function (knex, Promise) {
    return knex.schema.createTable('invoice', function (table) {
        table.uuid('id').primary();
        table.string('name');
        table.timestamps();
    })
};

exports.down = function (knex, Promise) {
    return knex.schema.dropTable('invoice');
};
