//var socket = require('socket.io-client')('http://localhost:3000');
/*
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http)('http://localhost:3000');
*/
/*
var socket = io('http://localhost:3000', {
    forceNew : true
});
*
io.emit('event.sendSms', {
    'mobileNuber' : 1,
    'testSms' : 'adsad'
});
*/
/*
socket.on('events', function(){

});
socket.on('event', function(data){});
socket.on('disconnect', function(){});
*/

var socket = io(App.smsurl);
 // socket.on('connect', function(){});
  //socket.on('event', function(data){});
  //socket.on('disconnect', function(){});
socket.emit('event.sendSms',App.data);