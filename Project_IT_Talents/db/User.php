<?php

require_once 'DbConfig.php';

class User
{
    private $db;
    private $isLogedIn = false;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }
 
    public function register($uname, $email, $password)
    {
       try
       {
           $new_password = password_hash($password, PASSWORD_DEFAULT);
   
           $statement = $this->db->prepare("INSERT INTO users(user_name, email, password) 
                                                       VALUES(:uname, :email, :password)");
              
           $statement->bindparam(":uname", $uname);
           $statement->bindparam(":email", $email);
           $statement->bindparam(":password", $new_password);            
           $statement->execute(); 

           return $statement; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
 
    public function login($email,$password)
    {
       try
       {
          $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
          $statement->execute(array(':email'=>$email));
          $userRow = $statement->fetch(PDO::FETCH_ASSOC);
          if($statement->rowCount() > 0)
          {
             if(password_verify($password, $userRow['password']))
             {
                $_SESSION['user_session'] = $userRow['user_id'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['user_session']))
      {
      	$this->isLogedIn = true;
        return $this->isLogedIn;
      }
   }
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
   }
   
	public function runQuery($sql)
	{
		$statement = $this->db->prepare($sql);
		return $statement;
	}
   
	public function send_mail($email,$message,$subject)
	{
		require_once('mailer/class.phpmailer.php');
		$mail = new PHPMailer();
//		$mail->IsMAIL();
//		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
//		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "aspmx.l.google.com";
		$mail->Port = 25;
		$mail->IsHTML(true);
		
		$mail->Username = "polly.georgieva7@gmail.com";
		$mail->Password = "polly3radi";
		
		$mail->SetFrom('polly.georgieva7@gmail.com','Paulina');
		$mail->AddAddress($email);
		$mail->AddReplyTo('polly.georgieva7@gmail.com','Paulina');
		
		$mail->Subject = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}
	
	public function insertComment($uname, $store, $comment, $rate)
	{
		try
		{
			$data = date('Y-m-d', time());
			 
			$statement = $this->db->prepare("INSERT INTO comments(data, user_name, store, comment, rate)
                                                       VALUES(:data, :uname, :store, :comment, :rate)");
	
			$statement->bindparam(":data", $data);
			$statement->bindparam(":uname", $uname);
			$statement->bindparam(":store", $store);
			$statement->bindparam(":comment", $comment);
			$statement->bindparam(":rate", $rate);
			$statement->execute();
			 
			return $statement;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
