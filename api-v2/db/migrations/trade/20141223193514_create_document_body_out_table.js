'use strict';

exports.up = function(knex, Promise) {
    return knex.schema.createTable('document_body_out',function(table){
        table.uuid('id');
        //reference to article
        table.string('article');
        //reference to units
        table.string('unit');
        table.integer('rabat');
        table.integer('tax_base');

        table.decimal('basic_price',6);
        table.decimal('price_with_tax',6);
        table.decimal('tax',6);
        table.decimal('total',6);
        table.timestamps();
    })
};

exports.down = function(knex, Promise) {
    return knex.dropTable('document_body_out');
};
