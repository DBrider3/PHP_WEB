<?php
// 1. 공통
require_once $_SERVER['DOCUMENT_ROOT'].'/admin.php';
// db연결
require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';
$connection= new mysqli($hn,$un,$pw,$db);

if($connection->connect_error) die($connection->connect_error);
// db검증 필수 사항

$query ="select * from board order by idx desc";
$result = $connection->query($query);
$total = mysqli_num_rows($result);

?>

<html>
<head>
  <link href="bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
  <style>

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

<!-- 게시판 리스트-->

  <h2 align=center>게시판</h2>
  <table align = center>
  <thead align = "center">
  <tr>
  <td width = "50" align="center" valign="middle">번호</td>
  <td width = "00" align = "center">제목</td>
  <td width = "50" align = "center">작성자</td>
  <td width = "50" align = "center">날짜</td>
  <td width = "50" align = "center">조회수</td>
  <td width = "50" align = "center">수정</td>
  <td width = "50" align = "center">삭제</td>
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
          <td width = "200" align = "center">
          <a href = "admin_board_view.php?idx=<?php echo $rows['idx']?>">
          <?php echo $rows['title']?></td>
            <td width = "50" align = "center"><?php echo $rows['id']?></td>
          <td width = "100" align = "center"><?php echo $rows['date']?></td>
          <td width = "50" align = "center"><?php echo $rows['hit']?></td>
          <th width = "10" align = "center">
            <a class="btn btn-primary" href="admin_board_modify.php?idx=<?php echo $rows['idx'] ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
          </th>
          <th width = "10" align = "center">
            <a class="btn btn-warning" href="admin_board_delete.php?del_idx=<?php echo $rows['idx']?>" onclick="return confirm('해당 글을 삭제할까요?')">
            <span class="glyphicon glyphicon-remove"></span>Del</a>
          </tr>
  <?php
          $total--;
          }
  ?>
  </tbody>
  </table>



  </th>
</body>
</html>
