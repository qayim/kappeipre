<?php
	session_start();
	require_once "pdo.php";
	
	$_SESSION['cid'] = $_GET['cid'];
	$coffeeid = $_SESSION['cid'];

  $stmt = $pdo->prepare("SELECT * from coffee where cid = :cid");
  $stmt->execute(array(":cid" => $coffeeid));
  $deal = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt = $pdo->prepare("DELETE FROM coffee where cid = :cid");
  if ($stmt->execute(array(":cid" => $coffeeid))) {
    $_SESSION['error'] = "Coffee deleted";
            header("Location: main.php");
            return;
  }
  else {
    header('HTTP/1.1 9988 Error');
    die(json_encode(array('message' => 'DELETE ERROR', 'code' => 9988)));
  }

?>