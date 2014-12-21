var testController = require('./controllers/test-controller.js');
console.log(testController.getAll());
var routes = require('./routes/routes.js');
var app=require('express')();

routes.generateRoutes(app,'trade');
app.listen(3000);