<?php
	if(session_status() !== PHP_SESSION_ACTIVE){
		session_start();
	}
	
	session_destroy();

	header('location: http://localhost/gleetech/crm');
?>