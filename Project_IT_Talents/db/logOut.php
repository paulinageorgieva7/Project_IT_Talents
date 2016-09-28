<?php

require_once 'DbConfig.php';


if (!empty($_SESSION['user_session'])) {
	$user->logout();
	header("Location: ../index.php");
}
