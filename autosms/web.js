module.exports = function(app, config){

	// Index
	app.get('/', function(req, res){
	  res.send('Socket Server Started....');
	});

}