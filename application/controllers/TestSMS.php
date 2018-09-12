<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestSMS extends MY_Controller {

	function __construct() {
		parent::__construct();
        /*
		if (!$this->session->userdata('my_auth')) {
			//redirect('app/login');
		}
        */    
        $this->load->library('Smslib');
        
	}
    function index(){
       // $cmd = sprintf('gammu sendsms TEXT %s -textutf8 %s', 13213213, escapeshellarg('asdasd and'));
        //print_r($cmd);die;
        $arrayToSend[] = [
            'mobileNumber' => '09386393750',
            'textSms' => 'months and the amount of Php, Thank you. 1'
        ];
        $arrayToSend[] = [
            'mobileNumber' => '09386393750',
            'textSms' => 'months and the amount of Php, Thank you. 2'
        ];
        
       //  print_r($arrayToSend);die;
        /*
        $arrayToSend[] = [
            'mobileNumber' => '09386393750',
            'textSms' => 'months and the amount of Php, Thank you. 3'
        ];*/
       //$this->loadJS('custom/sensSMS.js',['data' => array('dada' => 'asdsagdgfd')]);
        $this->loadJS('custom/sensSMS.js',['data' => json_encode(array('toSendData' =>$arrayToSend))]);

        $this->load->view('template/adminlte',array_merge([
			'page_view' => 'pages/testSMS',
			'page_tittle' => 'test',
			'page_webTittle' => 'test',
		],[]));
       // $this->load->view('pages/testSMS');   
    }
    function index_back(){
        $dataArray[0] = array(
            'mobileNumber' => '09386393750',
            'textSms' => 'Hi 1'
        );
        $dataArray[1] = array(
            'mobileNumber' => '09386393750',
            'textSms' => 'Hi 2'
        );
        $dataArray[2] = array(
            'mobileNumber' => '09386393750',
            'textSms' => 'Hi 3'
        );
        //$this->smslib->sendSms($dataArray);
    $this->smslib->testSend($dataArray);

        //$this->SendSMS('https://sample.smshosts.com/', 'username', 'password', '+44999999999', 'Test Message');
    // $this->load->view('pages/testSMS');   
       // SendSMS('https://sample.smshosts.com/', 'username', 'password', '+44999999999', 'Test Message');
    }
    function sensMessage(){
       // $this->Smslib->sendSms(array( 'asd' => 1 ));
    }
    function SendSMS ($hostUrl, $username, $password, $phoneNoRecip, $msgText,
                  $n1 = NULL, $v1 = NULL, $n2 = NULL, $v2 = NULL, $n3 = NULL, $v3 = NULL, 
                  $n4 = NULL, $v4 = NULL, $n5 = NULL, $v5 = NULL, $n6 = NULL, $v6 = NULL, 
                  $n7 = NULL, $v7 = NULL, $n8 = NULL, $v8 = NULL, $n9 = NULL, $v9 = NULL  ) { 

// Parameters:
//  $hostUrl – URL of the NowSMS server (e.g., http://127.0.0.1:8800 or
//             https://sample.smshosts.com/
//  $username – “SMS Users” account on the NowSMS server
//  $password – Password defined for the “SMS Users” account on the NowSMS Server
//  $phoneNoRecip – One or more phone numbers (comma delimited) to receive the message
//  $msgText – Text of the message
//  $n1-$n9 / $v1-$v9 - Additional optional URL parameters, encoded as name/value pairs
//                      Example: charset=iso-8859-1 encoded as 'charset', 'iso-8859-1'
 
   $postfields = array('Phone'=>"$phoneNoRecip", 'Text'=>"$msgText");
   if (($n1 != NULL) && ($v1 != NULL)) $postfields[$n1] = $v1;
   if (($n2 != NULL) && ($v2 != NULL)) $postfields[$n2] = $v2;
   if (($n3 != NULL) && ($v3 != NULL)) $postfields[$n3] = $v3;
   if (($n4 != NULL) && ($v4 != NULL)) $postfields[$n4] = $v4;
   if (($n5 != NULL) && ($v5 != NULL)) $postfields[$n5] = $v5;
   if (($n6 != NULL) && ($v6 != NULL)) $postfields[$n6] = $v6;
   if (($n7 != NULL) && ($v7 != NULL)) $postfields[$n7] = $v7;
   if (($n8 != NULL) && ($v8 != NULL)) $postfields[$n8] = $v8;
   if (($n9 != NULL) && ($v9 != NULL)) $postfields[$n9] = $v9;
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $hostUrl);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
// TODO: This script does not currently validate SSL Certificates
// curl_setopt($ch, CURLOPT_VERBOSE, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
// curl_setopt($ch, CURLOPT_CAINFO, 'cacert.pem');
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // change to 1 to verify cert
   curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:')); 
   $result = curl_exec($ch);

   return $result;

}
    
}