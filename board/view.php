<!DOCTYPE>
<?php
session_start();
$is_logged = $_SESSION['is_logged'];
// db연결
require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';

if($is_logged=='YES') {
  $user_id = $_SESSION['id'];
  $message = $user_id . ' 님, 로그인 했습니다.';
}
else echo "<script>location.replace('/member/login.php');</script>";

$connection= new mysqli($hn,$un,$pw,$db);

if($connection->connect_error) die($connection->connect_error);
// db검증 필수 사항

$idx = $_GET['idx'];

$query = "select title, content, date, hit, id from board where idx =$idx";
$result = $connection->query($query);
$rows = mysqli_fetch_assoc($result);

// 조회수
$hit = "update board set hit=hit+1 where idx=$idx";
$connection->query($hit);


?>


<html>
<head>
  <TITLE>Dominic's WEB ★</TITLE>
  <meta charset="utf-8">
  <link href="bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
  <style>
  h2 {
    color:blue;
  }
  ul {
    list-style-type: none;
    margin:0;
    padding:0;
    overflow:hidden;
    background-color:#333;
  }
  li {
    float:left;
  }
  li a, .dropbtn {
    display:inline-block;
    color:white;
    text-align:center;
    padding:14px 16px;
    text-decoration:none;
  }
  li a:hover, .dropdown:hover .dropbtn {
    background-color:red;
  }

  li.dropdown {
    display:inline-block;
  }

  .dropdown-content {
    display:none;
    position:absolute;
    background-color:#f1f1f1;
    min-width:160px;
    box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index:1;
  }
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color:green;
  }

  .dropdown:hover .dropdown-content
  {
    display:block;
  }

  view_table {
    border: 1px solid #444444;
    margin-top: 30px;
  }
  .view_title {
    height: 30px;
    text-align: center;
    background-color: #cccccc;
    color: white;
    width: 1000px;
  }
  .view_id {
    text-align: center;
    background-color: #EEEEEE;
    width: 30px;
  }
  .view_id2 {
    background-color: white;
    width: 60px;
  }
  .view_hit {
    background-color: #EEEEEE;
    width: 30px;
    text-align: center;
  }
  .view_hit2 {
    background-color: white;
    width: 60px;
  }
  .view_content {
    padding-top: 20px;
    border-top: 1px solid #444444;
    height: 500px;
  }
  .view_btn {
    width: 700px;
    height: 200px;
    text-align: center;
    margin: auto;
    margin-top: 50px;
  }
  .view_btn1 {
    height: 50px;
    width: 100px;
    font-size: 20px;
    text-align: center;
    background-color: white;
    border: 2px solid black;
    border-radius: 10px;
  }
  .view_comment_input {
    width: 700px;
    height: 500px;
    text-align: center;
    margin: auto;
  }
  .view_text3 {
    font-weight: bold;
    float: left;
    margin-left: 20px;
  }
  .view_com_id {
    width: 100px;
  }
  .view_comment {
    width: 500px;
  }

</style>
</head>
<body>
  <h2>Dominic's WEB ★</h2>
  <h2><?php
  echo $message;
  ?></h2>
  <ul>
    <li><a href="/index.php">HOME</a></li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">WELCOME</a>
      <div class="dropdown-content">
        <a href="/member/logout.php">LOGOUT</a>
        <a href="/member/signup.php">SIGN UP</a>
      </div>
    </li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">POST</a>
      <div class="dropdown-content">
        <a href="/board/list.php">LIST</a>
        <a href="/board/write.php">WRITE</a>
      </div>
    </li>
  </ul>


<!-- 게시판 -->
<table class="view_table" align=center>
      <tr>
              <td colspan="4" class="view_title"><?php echo $rows['title']?></td>
      </tr>
      <tr>
              <td class="view_id">작성자</td>
              <td class="view_id2"><?php echo $rows['id']?></td>
              <td class="view_hit">조회수</td>
              <td class="view_hit2"><?php echo $rows['hit']?></td>
      </tr>


      <tr>
              <td colspan="4" class="view_content" valign="top">
              <?php echo $rows['content']?></td>
      </tr>
      </table>


      <!-- MODIFY & DELETE -->
      <div class="view_btn">
              <button class="view_btn1" onclick="location.href='./list.php'">목록으로</button>
              <button class="view_btn1" onclick="location.href='./modify.php?idx=<?=$idx?>&id=<?=$user_id?>'">수정</button>
              <button class="view_btn1" onclick="location.href='./delete.php?idx=<?=$idx?>&id=<?=$user_id?>'">삭제</button>
      </div>

</body>
</html>
