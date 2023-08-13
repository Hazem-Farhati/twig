<?php 
$host ='127.0.0.1';
$db='conge_db';
$user='root';
$pass='';
$charset='utf8mb4';
$dsn="mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo=new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e) {
    throw new PDOException($e->getMessage());
}

// require_once 'crud.php' ;
require_once  'models/user.php';
require_once  'models/vacationRequest.php';


$_user=new _user($pdo);
$vacation=new vacation($pdo);

$_user->InsertUser("admin","admin","admin@gmail.com","admin","","","");

?>