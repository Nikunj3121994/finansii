'use strict';

exports.up = function(knex, Promise) {
    return knex.schema.createTable('business_units',function(table){
        table.uuid('id').primary();
        table.string('name');
        table.string('code');
        //reference company
        table.string('company');
        table.uuid('type').references('business_unit_type.id');
        table.timestamps();
    })
};

exports.down = function(knex, Promise) {
    return knex.dropSchema('business_unit');
};
