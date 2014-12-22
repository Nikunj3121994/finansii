var testController = require('./controllers/test-controller.js');
console.log(testController.getAll());
var routes = require('./routes/routes.js');
var app=require('express')();
var bodyParser = require('body-parser');
var multer = require('multer');

app.use(bodyParser.json()); // for parsing application/json
app.use(bodyParser.urlencoded({ extended: true })); // for parsing application/x-www-form-urlencoded
app.use(multer()); // for parsing multipart/form-data

routes.generateRoutes(app,'trade');
app.listen(3000);