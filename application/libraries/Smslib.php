    <?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once("./vendor/dompdf/dompdf/autoload.inc.php");

class Smslib {
    protected $ci;
    
    function __construct(){
        $this->ci = &get_instance();    
    }

    function sendSms( $sendData = array() ){
       //gammu sendsms TEXT 082111978168 -text "Halooo .."
       //09386393750
       if(!empty($sendData)){
           foreach($sendData as $sd){
               // print_r($sd['mobileNumber']);
               $toSend = 'gammu sendsms TEXT '.$sd['mobileNumber'].' -text "'.$sd['textSms'].'"';
               print_r($toSend);die;
             //exec($toSend);
            //sleep(5);
           }
       }
        //exec('ipconfig');
    }

    function testSend($sendData = array()){
       // $ro = 'gammu sendsms TEXT 09386393750 -text "Hi 1"';
        //exec($ro);

        $log = date('Y-m-d H:i:s').PHP_EOL;
        $file = 'sms.log';
        foreach($sendData as $rec) {
        $recs = filter_var($rec['mobileNumber'], FILTER_SANITIZE_NUMBER_INT);
        
        if(!empty($rec)) {
                $cmd = sprintf('gammu sendsms TEXT %s -textutf8 %s', $recs, escapeshellarg($rec['textSms']));
                $log.= $cmd.PHP_EOL;
                $log.= shell_exec($cmd).PHP_EOL.PHP_EOL;
            }
    }
        file_put_contents($file, $log, FILE_APPEND | LOCK_EX);
    echo $log;


    }

}