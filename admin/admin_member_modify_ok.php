<!DOCTYPE html>
<html>
<head>
    <title>Dominic's WEB ★</title>
    <meta charset="utf-8" >
</head>
<?php
// 1. 공통 인클루드 파일
require_once $_SERVER['DOCUMENT_ROOT'].'/admin.php';
// db연결
require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';
$connection= new mysqli($hn,$un,$pw,$db);

if($connection->connect_error) die($connection->connect_error);
// db검증 필수 사항

extract($_POST); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄


// 회원 저장
$query = "update users set pw='$pw', email='$email' where idx='$idx'";
$result = $connection->query($query);
if($result) {
  // alert("회원이 수정 되었습니다.", "./admin_member_list.php");
  echo "<script>alert('수정되었습니다.');</script>";
  echo "<script>location.replace('admin_member_list.php');</script>";
}
else{
  // alert("실패.", "./admin_member_list.php");
  echo "<script>alert('실패.');</script>";
  echo "<script>location.replace('admin_member_list.php');</script>";
}


?>
