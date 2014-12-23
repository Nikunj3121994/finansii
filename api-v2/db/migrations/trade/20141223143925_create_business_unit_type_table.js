'use strict';

exports.up = function(knex, Promise) {
    return knex.schema.createTable('business_unit_types',function(table){
        table.uuid('id').primary();
        table.string('name');
        table.boolean('ddv');
        table.string('account_in');
        table.string('account_out');
        table.string('account_mid');
        table.timestamps();
    })
};

exports.down = function(knex, Promise) {
    return knex.dropSchema('business_unit_types');
};
