<!DOCTYPE html>
<html>
<head>
    <title>Dominic's WEB ★</title>
    <meta charset="utf-8" >
</head>
<?php
  // session 검증 부분
  session_start();
  $is_logged = $_SESSION['is_logged'];
  if($is_logged=='YES') {
    $user_id = $_SESSION['id'];
  }
  else echo "<script>location.replace('/member/login.php');</script>";
  // db연결
  require_once "../dbcon.php";
  $connection= new mysqli($hn,$un,$pw,$db);

  if($connection->connect_error) die($connection->connect_error);
  // db검증 필수 사항

  extract($_POST); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄

  // 업로드
  $tmpfile =  $_FILES['b_file']['tmp_name'];
  $o_name = $_FILES['b_file']['name'];
  $filename = basename($_FILES['b_file']['name']);
  // $filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
  $folder = "./upload/".$filename;

  if(move_uploaded_file($tmpfile,$folder)){
    echo "<script>alert('파일이 등록되었습니다.');</script>";
  }
  else{
    echo "<script>alert('파일이 등록되지 않았습니다.');</script>";
  }
  $date = date('Y-m-d H:i:s');

  // 검증
  $query_chk = "select id from board where idx='$idx'";
  $result_chk = $connection->query($query_chk);
  $rows = mysqli_fetch_assoc($result_chk);
  $id = $rows['id'];
  if($user_id!=$id){
    echo "<script>alert('권한이 없습니다.');</script>";
    echo "<script>location.replace('list.php');</script>";
  }
  else {
    // DB에 쿼리 날려주는 부분
    $query = "update board set title='$title', content='$content', date='$date' ,file='$o_name' where idx='$idx' and id='$id'";

    $result = $connection->query($query);
    if($result) {
      echo "<script>alert('수정되었습니다.');</script>";
      echo "<script>location.replace('./view.php?idx=$idx');</script>";
    }
    else{
      echo "<script>alert('실패.');</script>";
      echo "<script>location.replace('list.php');</script>";
    }
  }


  $connection->close();
?>
</html>
