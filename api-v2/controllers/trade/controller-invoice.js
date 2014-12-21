var invoice = {};
invoice.getAll = function(req,res){
    res.json({type:'get all invosdfsdfice'});
};
invoice.getOne = function(req,res){
    res.send(req.params.id);
};
invoice.save = function(req,res){
    res.send('save');
};
invoice.update = function(req,res){
    res.send('update');
};
module.exports = invoice;