<!DOCTYPE html>
<html>
<head>
    <title>Dominic's WEB ★</title>
    <meta charset="utf-8" >
</head>
<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/check.php';

  // db연결
  require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';
  $connection= new mysqli($hn,$un,$pw,$db);

  if($connection->connect_error) die($connection->connect_error);
  // db검증 필수 사항

  extract($_POST); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄


  // 업로드 보안
  $valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png");
  $file_extension = strrchr($filename, ".");
  // 업로드
  $tmpfile =  $_FILES['b_file']['tmp_name'];
  $o_name = $_FILES['b_file']['name'];
  $filename = basename($_FILES['b_file']['name']);
  // $filename = iconv("UTF-8", "EUC-KR",$_FILES['b_file']['name']);
  $folder = "./upload/".$filename;

  $valid_file_extensions = array(".jpg", ".jpeg", ".gif", ".png");
  $file_extension = strrchr($filename, ".");

  // 올라온 파일이 실제로 이미지인지 체크한다.
  // 만약 이미지라면 저장 폴더로 옮긴다.
  if (in_array($file_extension, $valid_file_extensions)) {
    $destination = $folder . $o_name;
    if(move_uploaded_file($tmpfile, $destination)){
      echo "<script>alert('파일이 등록되었습니다.');</script>";
    }
    else{
      echo "<script>alert('파일이 등록되지 않았습니다.');</script>";
    }
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
