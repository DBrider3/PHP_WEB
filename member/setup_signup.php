<!DOCTYPE html>
<html>
<head>
    <title>Dominic's WEB ★</title>
    <meta charset="utf-8" >
</head>
<?php
  // db연결
  require_once '/dbcon.php';
  $connection= new mysqli($hn,$un,$pw,$db);

  if($connection->connect_error) die($connection->connect_error);
  // db검증 필수 사항

  extract($_POST); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄

  // id 중복 검사
  id_check($connection,$user_id);
  // Password_Check
  if($user_pw!=$user_pw2){
    echo "<script>alert('패스워드가 일치하지 않습니다.');</script>";
  }
?>
<?php
  // DB에 쿼리 날려주는 부분
  add_user($connection,$user_id,$user_pw,$user_email);

  function add_user($conn, $id, $pw, $email)
  {
    $query = "INSERT INTO users ( id, pw, email ) VALUES('$id', '$pw', '$email')";
    $conn->query($query);
  }
  function id_check($conn, $id)
  {
    $query = "SELECT * FROM users WHERE id='$id'";
    $result=$conn->query($query);
    if($result->num_rows==1)
    {
      echo "<script>alert('이미 존재하는 ID 입니다.');</script>";
      echo "<script>location.replace('signup.php');</script>";
      exit();
    }
  }

  $connection->close();
?>
<script>
  alert("회원가입이 완료되었습니다.");
  location.replace('../index.php');
</script>
</html>
