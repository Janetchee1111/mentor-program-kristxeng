<?php

require_once('conn.php');

//使用PDO & Prepared Statement 
$stmt = $conn->prepare("SELECT id, username, password FROM $users_table " .
					"WHERE username = :username AND password = :password");
//bind parameters & execute
$stmt->bindParam(':username', $_POST['username']);
$stmt->bindParam(':password', $_POST['password']);
$stmt->execute();
//設定 fetch mode 為 fetch_assoc
$stmt->setFetchMode(PDO::FETCH_ASSOC);

if( $stmt->rowCount() === 1 ){
	$row = $stmt->fetch();
	setCookie('user_id', $row['id'], time()+3600*24);
	echo 'ok';
}else{

	echo 'error';
}

$conn = null;

/* 原本使用 MySQLi 的方式

$sql = "SELECT id, username, password FROM $users_table WHERE username = '" . $_POST['username']."'" .
			"AND password = '" . $_POST['password'] . "'";

$result = $conn->query( $sql );

if( $result->num_rows === 1 ){

	$row = $result->fetch_assoc();
	setcookie('user_id', $row['id'], time()+3600*24);
	echo 'ok';

}else{

	echo 'error';
}
*/

?>