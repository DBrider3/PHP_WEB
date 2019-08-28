<!DOCTYPE>
<?php
  //session
  session_start();
  $is_logged = $_SESSION['is_logged'];
  if($is_logged=='YES') {
    $user_id = $_SESSION['id'];
    $message = $user_id . ' 님, 로그인 했습니다.';
  }
  else echo "<script>location.replace('/member/login.php');</script>";

  // db연결
  require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';

  $connection= new mysqli($hn,$un,$pw,$db);

  if($connection->connect_error) die($connection->connect_error);
  // db검증 필수 사항

  extract($_POST); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄

  $date = date('Y-m-d H:i:s');            //Date

  $query = "insert into board (idx,title, content, date, hit, id)
                        values(null,'$title', '$content', '$date',0, '$user_id')";

  $result = $connection->query($query);
  if($result) {
    echo "<script>alert('글이 등록되었습니다.');</script>";
    header('Location: ../index.php'); //게시글 등록 성공 시 페이지 이동
  }
  else {
    echo "<script>alert('다시 확인하시고 입력해주세요.');</script>";
    echo "<script>location.replace('write.php');</script>";
  }
?>


<html>
<head>
  <TITLE>Dominic's WEB ★</TITLE>

  <meta charset="utf-8">

</head>

</html>
