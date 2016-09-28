<?php

require_once 'DbConfig.php';

$errorReg = [];

if(isset($_POST['regBtn']))
{

	$uname = trim($_POST['username']);
	$email = trim($_POST['email']);
	$password = trim($_POST['password']);
	$password2 = trim($_POST['password2']);

/*  $uname = isset($_POST['username']) ? $_POST['username'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$password = isset($_POST['password']) ? $_POST['password'] : '';
	$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
 */
	if(!$uname) {
		$errorReg[] = 'Name is required!';
	}
	
	if(!$email) {
		$errorReg[] = 'Email is required!';
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errorReg[] = 'Please enter a valid email address!';
	}
	
	if(!$password) {
		$errorReg[] = 'Password is required!';
	}
	else if(strlen($password) < 6){
		$errorReg[] = 'Password must be atleast 6 characters';
	}
	else if ($password != $password2) {
		$errorReg[] = 'Passwords are different!';
	}

	if (empty($errorReg)) {
		try
		{
			$statement = $DB_con->prepare("SELECT user_name, email FROM users WHERE user_name=:uname OR email=:email");
			$statement->execute(array(':uname'=>$uname, ':email'=>$email));
			$row = $statement->fetch(PDO::FETCH_ASSOC);
			
			if($row['user_name'] == $uname) {
				$errorReg[] = "Username is already taken!";
			}
			
			else if($row['email'] == $email) {
				$errorReg[] = "Email is already taken!";
			}
			
			else
			{
				
				if($user->register($uname, $email, $password))
				{		
					$user->redirect('index.php');					
				}
			}
 
		}
		
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
}



/* if ($errorReg == []) {
	return true;
} else {
	return json_encode($errorReg);
} */
