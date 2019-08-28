<!DOCTYPE html>
<html>
<head>
    <title>Dominic's WEB ★</title>
    <meta charset="utf-8" >
</head>
<?php
  session_start();
  // db연결
  require_once "../dbcon.php";
  $connection= new mysqli($hn,$un,$pw,$db);

  if($connection->connect_error) die($connection->connect_error);
  // db검증 필수 사항

  extract($_GET); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄

  $date = date('Y-m-d H:i:s');

  // DB에 쿼리 날려주는 부분
  $query = "update board set title='$title', content='$content', date='$date' where idx=$idx";
  $result = $connection->query($query);
  if($result) {
    echo "<script>alert('수정되었습니다.');</script>";
    echo "<script>location.replace('./view.php?idx=$idx');</script>";
  }
  else{
    echo "<script>alert('실패.');</script>";
    echo "<script>location.replace('login.php');</script>";
  }

  $connection->close();
?>
</html>
