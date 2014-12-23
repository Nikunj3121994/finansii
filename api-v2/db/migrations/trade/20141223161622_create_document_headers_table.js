'use strict';

exports.up = function(knex, Promise) {
    return knex.schema.createTable('document_headers',function(table){
        table.uuid('id').primary();
        table.string('document_number');
        table.timestamp('document_date');
        table.uuid('business_unit_id').references('business_units.id');
        table.timestamps();
    })
};

exports.down = function(knex, Promise) {
    return knex.dropTable('document_headers');
};
