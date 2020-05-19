<?php

if (!isset($_SERVER [ 'PHP_AUTH_USER' ])) {
	header ( "WWW-Authenticate: Basic realm=\"Private Area\"");
	header ("HTTP/1.0 401 Unauthorized");
	print "Sorry, you need proper credentials";
	exit;
} else {
	if (($_SERVER['PHP_AUTH_USER'] == 'admin'  && ($_SERVER['PHP_AUTH_PW'] == '1234'))) {
		print "Goal";
	} else {	
		header ( "WWW-Authenticate: Basic realm=\"Private Area\"");
		header ("HTTP/1.0 401 Unauthorized");
		print "Sorry, you need proper credentials";
	}
}
