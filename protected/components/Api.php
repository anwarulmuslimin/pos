<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Api extends Controller
{
	// terdapat 3 buah parameter, data sebagai parameter data, url untuk mengetahui akan mengakses url mana service nya, method untuk mengetahui apa metode yang digunkana (post, get, put)
	public $password="admin";
	public $username="admin";
	public function submit_cURL ($data,$url,$method) 
	 {
	   $data[]="X_ASCCPE_PASSWORD : $this->password"; // data untuk autentikasi password
	   $data[]="X_ASCCPE_USERNAME : $this->username"; // data untuk autentikasi username
	   $ch = curl_init();
	   curl_setopt($ch, CURLOPT_URL, $url);
	   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	   curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
	   if($method=='POST')
		  curl_setopt($ch, CURLOPT_POST, 1);
	   else if($method=='PUT')
		  curl_setopt($ch, CURLOPT_PUT, 1);
	   curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
	   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	   $result = curl_exec($ch);
	   curl_close ($ch);

	   return $result;
	}

	private function _sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		// set the status
		$status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
		header($status_header);
		// and the content type
		header('Content-type: ' . $content_type);
	 
		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo $body;
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';
	 
			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}
	 
			// servers don't always have a signature turned on 
			// (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];
	 
			// this should be templated in a real-world solution
			$body = '
				<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
				<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
					<title>' . $status . ' ' . $this->_getStatusCodeMessage($status) . '</title>
				</head>
				<body>
					<h1>' . $this->_getStatusCodeMessage($status) . '</h1>
					<p>' . $message . '</p>
					<hr />
					<address>' . $signature . '</address>
				</body>
				</html>';
				
			echo $body;
		}
		Yii::app()->end();
	}

	private function _getStatusCodeMessage($status)
	{
		// these could be stored in a .ini file and loaded
		// via parse_ini_file()... however, this will suffice
		// for an example
		$codes = Array(
			200 => 'OK',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
		);
		return (isset($codes[$status])) ? $codes[$status] : '';
	}

	private function _checkAuth()
	{
		// Check if we have the USERNAME and PASSWORD HTTP headers set?
		if(!(isset($_SERVER['HTTP_X_USERNAME']) and isset($_SERVER['HTTP_X_PASSWORD']))) {
			// Error: Unauthorized
			$this->_sendResponse(401);
		}
		$username = $_SERVER['HTTP_X_USERNAME'];
		$password = $_SERVER['HTTP_X_PASSWORD'];
		// Find the user
		$user=User::model()->find('LOWER(username)=?',array(strtolower($username)));
		if($user===null) {
			// Error: Unauthorized
			$this->_sendResponse(401, 'Error: User Name is invalid');
		} else if(!$user->validatePassword($password)) {
			// Error: Unauthorized
			$this->_sendResponse(401, 'Error: User Password is invalid');
		}
	}

}