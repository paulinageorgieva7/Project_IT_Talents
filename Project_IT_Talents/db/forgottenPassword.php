<?php

$msg = '';

if($user->is_loggedin())
{
	$user->redirect('index.php');
}

if(isset($_POST['sendPassword']))
{
	$email = $_POST['emailForgottenPass'];

	$statement = $user->runQuery("SELECT user_id FROM users WHERE email=:email LIMIT 1");
	$statement->execute(array(":email"=>$email));
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	if($statement->rowCount() == 1)
	{
		$length = 8;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$newPassword = '';
		for ($i = 0; $i < $length; $i++) {
			$newPassword .= $characters[rand(0, strlen($characters) - 1)];
		}
			
		$encrypt = password_hash($newPassword, PASSWORD_DEFAULT);

		$statement = $user->runQuery("UPDATE users SET password=:newPassword WHERE email=:email");
		$statement->execute(array(":newPassword"=>$encrypt,"email"=>$email));

		$message= "
		Hello, $email
		<br /><br />
		We got requested to reset your password!
		<br /><br />
		This is your new password: $newPassword
		<br /><br />
		Thank you :)
		";
		$subject = "Password Reset";

		$user->send_mail($email,$message,$subject);

		$msg = "We've sent you an email!";		
	}
	else
	{
		$msg = "Sorry! This email not found";
	}
}