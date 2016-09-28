<?php

require_once 'DbConfig.php';

$error = '';

if(isset($_POST['btnLogin']))
{
	$email = isset($_POST['emailLogin']) ? $_POST['emailLogin'] : '';
	$password = isset($_POST['passwordLogin']) ? $_POST['passwordLogin'] : '';

	if($user->login($email,$password))
	{	
		$user->is_loggedin();
//		$user->redirect('index.php');
		return true;
		
		
	}
	else
	{
		$error = "This user does not exist!";
		return false;
	}
}
