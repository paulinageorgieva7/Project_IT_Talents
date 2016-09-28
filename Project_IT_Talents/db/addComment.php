<?php

require_once 'DbConfig.php';

$msg2 = '';
$err = '';

if($user->is_loggedin()) 
{
	$userID = $_SESSION['user_session'];
	
	$statement = $user->runQuery("SELECT user_name FROM users WHERE user_id=:userID LIMIT 1");
	$statement->execute(array(":userID"=>$userID));
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	
	if($statement->rowCount() == 1)
	{
		$uname = $row['user_name'];
	}
	
	if(isset($_POST['btnAddComments']))
	{
		$store = $_POST['store'];
		$rate = $_POST['rate'];
		$comment = $_POST['comment'];

		if (($store == 'none') || ($rate == 'none') || ($comment == '')) {
			$err = 'Fill all fields!';
		} 
		
		if (empty($err)) {
			try
			{
				$user->insertComment($uname, $store, $comment, $rate);	
				return true;
			}
			catch(PDOException $e)
			{
				echo $e->getMessage();
			}
		}		
	}
		
} else {
	$msg2 = 'You are not logged in!';
	return false;
}
