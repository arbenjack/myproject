
module.exports = function(http, config){

	// Start server on this port...
	http.listen(config.port, function(){
	  console.log('Server listening on *:3000');
	});
	
}