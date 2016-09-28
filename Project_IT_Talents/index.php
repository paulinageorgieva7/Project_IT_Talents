<?php 

require_once 'db/validation_register.php';
require_once 'db/validation_login.php';
//require_once 'db/forgottenPassword.php';
require_once 'db/addComment.php';
require_once 'db/fillterComments.php';



?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Shopping</title>
		<link REL="STYLESHEET"  TYPE="text/css" HREF="style.css"/>
		<script type="text/javascript" src="js/ajax.js"></script>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1bggRfT64K4ZstT1uk5owBwVpwQBFmfQ" ></script>	
		<script type="text/javascript" src="js/google_map.js"></script>		
		<script type="text/javascript" src="js/js.js"></script>

	</head>
	<body>
		<div id="page">
			<header>
				<div>
					<img src="images/logo.png">
					<ul>					
						<?php if (!$user->is_loggedin()) :?>
						<li id="loginLable">Login</li>
						<?php else :?>	
						<li id="loginLable"><a href="db/logOut.php">Logout</a></li>
						<?php endif;?>				
						<span>|</span>
						<li id="registration">Register</li>
					</ul>
				</div>
			</header>
			
			<section>
				<div id="map"></div>	
				
				<div id="listing">
					<ul>
						<li><a href="?store=Bulgaria Mall">Bulgaria Mall</a></li>
						<li><a href="?store=Mall of Sofia">Mall of Sofia</a></li>
						<li><a href="?store=Mega Mall Sofia">Mega Mall Sofia</a></li>
						<li><a href="?store=Paradise Center">Paradise Center</a></li>
						<li><a href="?store=Park Center">Park Center</a></li>
						<li><a href="?store=Princess Outlet">Princess Outlet</a></li>
						<li><a href="?store=Serdika Center">Serdika Center</a></li>
						<li><a href="?store=Sky City Mall">Sky City Mall</a></li>
						<li><a href="?store=Sofia Outlet Center">Sofia Outlet Center</a></li>
						<li><a href="?store=Sofia Ring Mall">Sofia Ring Mall</a></li>
						<li><a href="?store=The Mall">The Mall</a></li>
						<li><a href="?store=TZUM">TZUM</a></li>
					</ul>
					<button type="submit" id="addComList">Add Comment</button>
				</div>		
			</section>
			
			<div id="commentsContainer">
				<?php require 'comments.php';?>
			</div>
			
			
			<footer>
				<div id="aboutus">
					<h4>About Us</h4>
					<p>Hello from the "Shopping and the city" team. 
						We exist, so we could help you when you decide to go out for shopping, 
						so you could spend less time wandering around and more time on those beauuutiful 
						shoes from that brochure.</p>
				</div>
				
				
				<div id="contactus">
					<h4>Contact Us</h4>
					<p>Call us: +359/883-395-699</p>
					<p>Email: polly.georgieva7@gmail.com</p>
				</div>
				
				<div id="talants">
					<div id="line"></div>
					<h4>IT Talants Season 6</h4>
				</div>
			</footer>
			
			
			<!-- POP UPS -->
			
			<div id="register">
				<span class="close">X</span>
				<h4>Registration</h4>
				<form method="post" id="regForm">
					
					<div>
						<label>User Name</label>
						<input type="text" name="username"/>
					</div>
					<div>
						<label>Email</label>
						<input type="text" name="email"/>
					</div>
					<div>
						<label>Password</label>
						<input type="password" name="password"/>
					</div>
					<div>
						<label>Confirm Password</label>
						<input type="password" name="password2"/>
					</div>
	                	
					<button type="submit" id="regBtn" name="regBtn">Register</button>
					
					<?php foreach ($errorReg as $e):?>
						<p style="color:red; font-size:0.8em"><?php echo $e . PHP_EOL?></p>
				 	<?php endforeach;?>
					
				</form>

			</div>
	
			<div id="login">
				<span class="close">X</span>
				<h4>Login</h4>
				<form method="post" id="loginForm">
					<div>
						<label>Email</label>
						<input type="text" name="emailLogin"/>
					</div>
					<div>
						<label>Password</label>
						<input type="password" name="passwordLogin"/>
					</div>
					
					<button type="submit" id="loginBtn" name="btnLogin">Login</button>
					<p style="color:red; font-size:0.8em"><?= $error ?></p>
					
					<span id="forgottenPassword">Forgotten password</span>
								
					<p style="color:red; font-size:0.8em"></p>
	                
					<div id="forgPass">
						<label>Email</label>
						<input type="text" name="emailForgottenPass"/>
						<button type="submit" name="sendPassword">Send</button>
						
			<!--		<p style="color:red; font-size:0.8em"><?= $msg ?></p>	-->
					</div>
				</form>				
			</div>
			
			<div id="comment">
				<span class="close">X</span>
				<h4>Add Comment</h4>
				<form method="post" id="commentForm">
					<div>
						<label>Select Store</label>
						<select name="store">
							<option value="none">--</option>
							<option value="Bulgaria Mall">Bulgaria Mall</option>
							<option value="Mall of Sofia">Mall of Sofia</option>
							<option value="Mega Mall Sofia">Mega Mall Sofia</option>
							<option value="Paradise Center">Paradise Center</option>
							<option value="Park Center">Park Center</option>
							<option value="Princess Outlet">Princess Outlet</option>
							<option value="Serdika Center">Serdika Center</option>
							<option value="Sky City Mall">Sky City Mall</option>
							<option value="Sofia Outlet Center">Sofia Outlet Center</option>
							<option value="Sofia Ring Mall">Sofia Ring Mall</option>
							<option value="The Mall">The Mall</option>
							<option value="TZUM">TZUM</option>
						</select> 
					</div>
					<div>
						<label>Insert Comment</label>
						<textarea name="comment" rows="6" cols="20"></textarea>
					</div>
					<div>
						<label>Rate</label>
						<select name="rate">
							<option value="none">--</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select> 
					</div>
					<p style="color:red; font-size:0.8em; margin: 5px;"><?= $msg2 ?></p>
					<p style="color:red; font-size:0.8em;"><?= $err ?></p>
					<button type="submit" id="commentBtn" name="btnAddComments">Add Comment</button>
				</form>
			</div>	
				
		</div>
		
		
	</body>
</html>