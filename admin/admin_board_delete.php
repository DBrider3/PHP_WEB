<?php

  require_once $_SERVER['DOCUMENT_ROOT'].'/admin.php';
  // db연결
  require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';

    if(isset($_GET['del_idx']))
    {
	$stmt = $connection->prepare('DELETE FROM board WHERE idx =:del_idx');
	$stmt->bindParam(':del_idx',$_GET['del_idx']);
	$stmt->execute();
    }

    header("Location: admin_board_list.php");
?>
