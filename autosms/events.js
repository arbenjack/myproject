module.exports = function(io, exec, escapeshellarg){
	
	io.on('connection', function(socket){
	    
	    socket.on('event.sendSms', function(data){
				
			let toLoop = JSON.parse(data);
			var shell = require('./shellHelper');
			var arrays = [];
			var stringToSend = '';
			forLoop = 0;
			for (let key in toLoop['toSendData']) {
				var obj = toLoop['toSendData'][key];
				//console.log(obj);
				//arrays.push('gammu sendsms TEXT '+obj.mobileNumber+' -textutf8 "'+escapeshellarg(obj.textSms)+'"');
					// keep the event loop busy
					/*
				exec('gammu sendsms TEXT '+obj.mobileNumber+' -textutf8 "'+escapeshellarg(obj.textSms)+'"', (err, stdout, stderr) => {
					if (err) {
						// node couldn't execute the command
						//return;
						console.log(err);
					  }
					
					  // the *entire* stdout and stderr (buffered)
					  console.log(`stdout: ${stdout}`);
					  console.log(`stderr: ${stderr}`);
					  });
					  */
					 
				if(toLoop['toSendData'].length > 1 && forLoop == 0){
					stringToSend = 'gammu sendsms TEXT '+obj.mobileNumber+' -textutf8 "'+obj.textSms+'"';
				}
				if(toLoop['toSendData'].length > 1 && forLoop > 0){
					stringToSend = stringToSend + ' && gammu sendsms TEXT '+obj.mobileNumber+' -textutf8 "'+obj.textSms+'"';
				}
				if(toLoop['toSendData'].length == 1 && forLoop == 0){
					stringToSend = 'gammu sendsms TEXT '+obj.mobileNumber+' -textutf8 "'+obj.textSms+'"';	
				}

				forLoop = forLoop+1;
			 }
			 console.log(stringToSend);
	
		exec(stringToSend, (err, stdout, stderr) => {
			if (err) {
				// node couldn't execute the command
				//return;
				console.log(err);
			  }
			
			  // the *entire* stdout and stderr (buffered)
			  console.log(`stdout: ${stdout}`);
			  console.log(`stderr: ${stderr}`);
			  }); 
			  
		/*
		shell.series(arrays, function(err){
		   console.log('executed many commands in a row'); 
		});
		*/
					
					/*
					var spawn = require('child_process').spawn;

var retour = [];
var gammu = spawn(`gammu`, [`-c`, '/etc/gammu-smsdrc', `sendsms`, 'TEXT', '06xxxxxxxx', '-text', 'Bip bip']);
gammu.stdout.on('data', function(data){
	retour.push(data.toString('ascii'));
});
gammu.stderr.on('data', function(err){
	retour.push(err.toString('ascii'));
});
gammu.on('close', function(){
	console.log('Gammu finished');
	console.log(retour.join(' - '));
});
*/


				/*
				exec('gammu sendsms TEXT '+obj.mobileNumber+' -text "'+obj.textSms+'"', (err, stdout, stderr) => {
				  if (err) {
					  // node couldn't execute the command
					  //return;
					  console.log(err);
					}
				  
					// the *entire* stdout and stderr (buffered)
					console.log(`stdout: ${stdout}`);
					console.log(`stderr: ${stderr}`);
					});
					*/
	    });

	});
}