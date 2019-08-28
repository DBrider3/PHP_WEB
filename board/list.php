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

$query ="select * from board order by idx desc";
$result = $connection->query($query);
$total = mysqli_num_rows($result);

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
  table{
        border-top: 1px solid #444444;
        border-collapse: collapse;
  }
  tr{
          border-bottom: 1px solid #444444;
          padding: 10px;
  }
  td{
          border-bottom: 1px solid #efefef;
          padding: 10px;
  }
  table .even{
          background: #efefef;
  }
  .text{
          text-align:center;
          padding-top:20px;
          color:#000000
  }
  .text:hover{
          text-decoration: underline;
  }
  a:link {color : #57A0EE; text-decoration:none;}
  a:hover { text-decoration : underline;}
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


<!-- 게시판 리스트-->
  <h2 align=center>게시판</h2>
  <table align = center>
  <thead align = "center">
  <tr>
  <td width = "50" align="center">번호</td>
  <td width = "500" align = "center">제목</td>
  <td width = "100" align = "center">작성자</td>
  <td width = "200" align = "center">날짜</td>
  <td width = "50" align = "center">조회수</td>
  </tr>
  </thead>

  <tbody>
  <?php
          while($rows = mysqli_fetch_assoc($result)){ //DB에 저장된 데이터 수 (열 기준)
                  if($total%2==0){
  ?>                      <tr class = "even">
                  <?php   }
                  else{
  ?>                      <tr>
                  <?php } ?>
          <td width = "50" align = "center"><?php echo $total?></td>
          <td width = "500" align = "center">
          <a href = "view.php?idx=<?php echo $rows['idx']?>">
          <?php echo $rows['title']?></td>
            <td width = "100" align = "center"><?php echo $rows['id']?></td>
          <td width = "200" align = "center"><?php echo $rows['date']?></td>
          <td width = "50" align = "center"><?php echo $rows['hit']?></td>
          </tr>
  <?php
          $total--;
          }
  ?>
  </tbody>
  </table>

  <div class = text>
  <font style="cursor: hand"onClick="location.href='./write.php'">글쓰기</font>
  </div>

</body>
</html>
