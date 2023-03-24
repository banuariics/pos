<?php session_start();
session_unset();

// destroy the session
session_destroy();

 $json_data = array(
				"result"=>1,
				"msg"=>'BERHASIL LOGOUT',
		  
			);

 echo json_encode($json_data); 