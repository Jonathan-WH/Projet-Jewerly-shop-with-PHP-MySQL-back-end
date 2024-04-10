<?php
session_start(); 
// testez si la variable de session user existe,
// si non faire une redirection sur login.php
if ( isset($_SESSION['username']) == false ) {
	header('Location:../back-admin.php');
	exit();
}
else {
	$user = $_SESSION['username'];
}
?>