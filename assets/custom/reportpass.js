$(document).ready(function(){
    
    $(document).on('click','.sendsmsBtn',function(){
            var loanActt = $(this).attr('loanAcct');
           // console.log(loanActt);
           $.ajax({
               url: App.siteurl + 'reports/sendSMS',
               type: 'POST',
               data: {
                loanAccount : loanActt
               },
           success: function(result){
           
            var dataTosend = JSON.parse(result);
            var socket = io(App.smsurl);
            socket.emit('event.sendSms',JSON.stringify(dataTosend['data']));
           // console.log(dataTosend['data']['toSendData'][0]);
            alert('Successfuly send sms to '+dataTosend['data']['toSendData'][0].name);
        }});
    });

});
