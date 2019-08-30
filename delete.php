<?php

    include('dbcon.php');

    session_start();
    $is_logged = $_SESSION['is_logged'];
    if($is_logged=='YES') {
      $user_id = $_SESSION['id'];
      if ($user_id == 'admin' && $_SESSION['is_admin']==1){
        $message = $user_id . ' , 관리자 로그인 했습니다.';
        // header("Location: admin.php");
      }
      else{
        $message = $user_id . ' 님, 로그인 했습니다.';
        header("Location: index.php");
      }
    }
    else echo "<script>location.replace('/member/login.php');</script>";


    if(isset($_GET['del_id']))
    {
  	$stmt = $connection->prepare('DELETE FROM users WHERE id =:del_id');
  	$stmt->bindParam(':del_id',$_GET['del_id']);
  	$stmt->execute();
    }

    header("Location: admin.php");
?>
