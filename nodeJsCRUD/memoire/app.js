
/**
 * Module dependencies.
 */

var express = require('express');
var routes = require('./routes');
var http = require('http');
var path = require('path');

//load offices route
var offices = require('./routes/offices'); 
var app = express();

var connection  = require('express-myconnection'); 
var mysql = require('mysql');

// all environments
app.set('port', process.env.PORT || 4300);
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');
//app.use(express.favicon());
app.use(express.logger('dev'));
app.use(express.json());
app.use(express.urlencoded());
app.use(express.methodOverride());

app.use(express.static(path.join(__dirname, 'public')));

// development only
if ('development' == app.get('env')) {
  app.use(express.errorHandler());
}

/*------------------------------------------
    connection peer, register as middleware
    type koneksi : single,pool and request 
-------------------------------------------*/

app.use(
    
    connection(mysql,{
        
        host: 'localhost',
        user: 'root',
        password : 'root',
        port : 3306, //port mysql
        database:'classicmodels'

    },'pool') //or single

);



app.get('/', routes.index);
app.get('/offices', offices.list);
app.get('/offices/add', offices.add);
app.post('/offices/add', offices.save);
app.get('/offices/delete/:id', offices.delete_offices);
app.get('/offices/edit/:id', offices.edit);
app.post('/offices/edit/:id',offices.save_edit);


app.use(app.router);

http.createServer(app).listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
});
