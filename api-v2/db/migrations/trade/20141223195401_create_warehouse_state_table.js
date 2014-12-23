'use strict';

exports.up = function(knex, Promise) {
    return knex.schema.createTable('warehouse_state',function(table){
        table.uuid('id');
        table.uuid('document_body_out_id').references('document_body_out.id');
        table.uuid('document_body_in_id').references('document_body_in.id');
        table.decimal('quantity',6);
        table.timestamps();
    })
};

exports.down = function(knex, Promise) {
    return knex.dropTable('document_body_in_out_connection');
};
