<?php
return array(
	/** set your paypal credential **/
	'client_id' =>'ASZ2D8E3OoLMfXNdaFefVosPsgjlbioUzeCqahaxe8s7WHBG4wXTzua_sF7yUMzKq7NdYDeviqGp-JaT',
	'secret' =>'ELJQRcQv5_fgzcTW5XWvw8-Fh43SISsV8jSLfLoSsr4Cs7BH1wdfVSPkKQDnsMRnGusq9pu4E7lgzngD',
	/**
	* SDK configuration 
	*/
	'settings' => array(
	/**
	* Available option 'sandbox' or 'live'
	*/
	'mode' => 'sandbox',
	/**
	* Specify the max request time in seconds
	*/
	'http.ConnectionTimeOut' => 5000,
	/**
	* Whether want to log to a file
	*/
	'log.LogEnabled' => true,
	/**
	* Specify the file that want to write on
	*/
	'log.FileName' => storage_path() . '/logs/paypal.log',
	/**
	* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
	*
	* Logging is most verbose in the 'FINE' level and decreases as you
	* proceed towards ERROR
	*/
	'log.LogLevel' => 'FINE'
	),
);