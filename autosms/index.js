var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
const { exec } = require('child_process');
var escapeshellarg = require('escapeshellarg')
//var mysql = require('mysql');
var config = require('./config')


require('./web')(app, config);

// ----- Listeners -----
require('./listeners')(http, config);

// ----- Events -----
require('./events')(io,exec,escapeshellarg);