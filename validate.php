<?php
    include './config.php';
    include './adminfunctions.php';

    if(isset($_POST['Password']))
    {
	    $password = $_POST['Password'];
	    if(verifyUsrLogin($password))
	    {
	    	header('Location: ./');
	    }
	    else
	    {
	    	header('Location: ./login.php');
	    }
    }
    else
    {
    	header('Location: ./login.php');
    }
?>