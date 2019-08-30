<!DOCTYPE html>
<html>
<head>
    <title>Dominic's WEB ★</title>
    <meta charset="utf-8" >
</head>
<?php
  session_start();
  // db연결
  require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';
  $connection= new mysqli($hn,$un,$pw,$db);

  if($connection->connect_error) die($connection->connect_error);
  // db검증 필수 사항

  extract($_POST); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄

  // DB에 쿼리 날려주는 부분
  $result = check_user($connection,$user_id,$user_pw);

  function check_user($conn, $id, $pw)
  {
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = $conn->query($query);
    return $result;
  }

  if($result->num_rows==1){
    $row=$result->fetch_array(MYSQLI_ASSOC); //하나의 열을 배열로 가져오기
    if($row['pw']==$user_pw){  //MYSQLI_ASSOC 필드명으로 첨자 가능
        $_SESSION['id']=$user_id;           //로그인 성공 시 세션 변수 만들기
        $_SESSION['is_logged'] = 'YES';
        $_SESSION['is_admin'] = $row['is_admin'];
        if(isset($_SESSION['id']))    //세션 변수가 참일 때
        {
          header('Location: ../index.php'); //로그인 성공 시 페이지 이동
        }
        else{
            echo "세션 저장 실패.";
        }
    }
    else{
      echo "<script>alert('다시 확인하시고 입력해주세요.');</script>";
      echo "<script>location.replace('login.php');</script>";
    }
  }
  else{
    echo "<script>alert('다시 확인하시고 입력해주세요.');</script>";
    echo "<script>location.replace('login.php');</script>";
  }

  $connection->close();
?>
</html>
