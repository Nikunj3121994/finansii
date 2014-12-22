var invoice = {};
var invoiceModel = require('../../models/trade/model-invoice.js');
invoice.getAll = function(req,res){
    new invoiceModel().fetchAll().then(function(m){
        res.send(m)
    });

};
invoice.getOne = function(req,res){
    invoiceModel.query('where','id','=',req.params.id).fetch().then(function(m){
        res.send(m);
    },function(err){
        res.send({msg:'Бараниот податок не постои'});
    });
};
invoice.save = function(req,res){
    invoiceModel.save(req.body).then(function(m){
        res.send(m)
    });

};
invoice.update = function(req,res){
    new invoiceModel({id: req.param.id}).save(req.params.body).then(function(m){
        res.send(m);
    },function(err){
        res.send(err);
    });
};
module.exports = invoice;