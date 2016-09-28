/**
 * 
 */

document.addEventListener('DOMContentLoaded', function () {
				
	// REGISTRATION, OPEN REG PANEL
	
	var register = document.getElementById('register');
	var registration = document.getElementById('registration');
	var closeReg = document.getElementsByClassName('close')[0];
	
	registration.onclick = function() {
	    register.style.display = "block";
	}
	

/*	document.getElementById('regForm').onsubmit = function (e) {
		
		//e.preventDefault();
		
		Ajax.request('POST', 'db/validation_register.php', true, function(response) {
		
			if(response) {
				
				window.location.href = 'index.php';
				
			} else {
				
				var data = JSON.stringify(response);
								
				document.querySelector('#register p').innerHTML = data;
			}
		});
	
	}*/
	
	closeReg.onclick = function() {
	    register.style.display = "none";
	}
	
	window.onclick = function(event) {
	    if (event.target == register) {
	    	register.style.display = "none";
	    }
	}
	
	// LOGIN, OPEN LOGIN PANEL
	
	var login = document.getElementById('login');
	var loginLable = document.getElementById('loginLable');
	var closeLogin = document.getElementsByClassName('close')[1];
	var logoutLable = document.getElementById('logoutLable');
	
	loginLable.onclick = function() {
		login.style.display = "block";
	}
	
/*	document.getElementById('loginForm').onsubmit = function (e) {
		//e.preventDefault();
		
		Ajax.request('POST', 'db/validation_login.php', true, function(response) {

			if (!response) {

				document.querySelector('#login p').innerHTML = "This user does not exist!";
				
			} else {
				
				window.location.href = 'index.php';
				
			}
		});
	
	}
*/
	closeLogin.onclick = function() {
		login.style.display = "none";
	}
	
	window.onclick = function(event) {
	    if (event.target == login) {
	    	login.style.display = "none";
	    }
	}
	
	
	//ADD COMMENT, OPEN ADD COMMENT PANEL
	
	var comment = document.getElementById('comment');
	var addComList = document.getElementById('addComList');
	var closeComment = document.getElementsByClassName('close')[2];
	var addComListInfo = document.getElementsByClassName('addComListInfo');
	
/*	document.getElementById('commentForm').onsubmit = function (e) {
		
		//e.preventDefault();
		
		Ajax.request('POST', 'db/addComment.php', true, function(response) {
		
			if(response) {
				
				window.location.href = 'index.php';
				
			} else {
				
				document.getElementById('commentForm').preventDefault();
			}
		});
	
	}*/

	addComList.onclick = function() {
		comment.style.display = "block";
	}
	
	addComListInfo.onclick = function() {
		comment.style.display = "block";
	}
	
	
	closeComment.onclick = function() {
		comment.style.display = "none";
	}
	
	window.onclick = function(event) {
	    if (event.target == comment) {
	    	comment.style.display = "none";
	    }
	}

	//FORGOTTEN PASSWORD
	
	var forgottenPassDiv = document.getElementById('forgPass');
	var forgPassBtn = document.getElementById('forgottenPassword');
	
	forgPassBtn.onclick = function() {
		forgottenPassDiv.style.display = "block";
	}
	
	
	
}, false);

		
		