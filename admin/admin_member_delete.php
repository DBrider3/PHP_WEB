<?php

  require_once $_SERVER['DOCUMENT_ROOT'].'/admin.php';
  // db연결
  require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';

    if(isset($_GET['del_id']))
    {
	$stmt = $connection->prepare('DELETE FROM users WHERE id =:del_id');
	$stmt->bindParam(':del_id',$_GET['del_id']);
	$stmt->execute();
    }

    header("Location: admin_member_list.php");
?>
