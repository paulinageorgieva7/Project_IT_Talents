<?php

session_start();

const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASS = "";
const DB_NAME = "registration_database";

try
{
     $DB_con = new PDO("mysql:host=localhost;dbname=registration_database", DB_USER, DB_PASS);
     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
     echo $e->getMessage();
}


include_once 'User.php';
$user = new User($DB_con);
