<?php

require_once 'DbConfig.php';

$msgStore = '';


function filterComments () {
	
		global $user;
	
		$store = isset($_GET['store']) ? $_GET['store'] : '';
		
		$statement = $user->runQuery("SELECT user_name, data, comment, rate FROM comments WHERE store=:store" );
		$statement->execute(array(":store"=>$store));
		$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
		
		
		$sum = 0;
		$avrg = 0;
		$countComments = count($rows);
		foreach ($rows as $row) {
			$sum += $row['rate'];	
		}
		
		$avrg = $sum / max($countComments, 1);
	
	return ['rows' => $rows, 'store' => $store, 'rate' => $avrg];
}

