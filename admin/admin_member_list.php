<?php
// 1. 공통
require_once $_SERVER['DOCUMENT_ROOT'].'/admin.php';
// db연결
require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';
$connection= new mysqli($hn,$un,$pw,$db);

if($connection->connect_error) die($connection->connect_error);
// db검증 필수 사항

$query ="select * from users order by idx desc";
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

<!-- 회원 리스트-->

  <h2 align=center>사용자 목록</h2>
  <table align = center>
  <thead align = "center">
  <tr>
  <td width = "50" align="center">아이디</td>
  <td width = "100" align = "center">패스워드</td>
  <td width = "100" align = "center">이메일</td>
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
                  <?php }

          if ($rows['id'] != 'admin'){
  ?>
          <td width = "50" align = "center"><?php echo $rows['id']?></td>
          <td width = "100" align = "center"><?php echo $rows['pw']?></td>
          <td width = "100" align = "center"><?php echo $rows['email']?></td>
          <th width = "10" align = "center">
            <a class="btn btn-primary" href="admin_member_modify.php?idx=<?php echo $rows['idx'] ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
          </th>
          <th width = "10" align = "center">
            <a class="btn btn-warning" href="admin_member_delete.php?del_id=<?php echo $rows['id']?>" onclick="return confirm('<?php echo $rows['id']?> 사용자를 삭제할까요?')">
      			<span class="glyphicon glyphicon-remove"></span>Del</a>
          </th>

    			</tr>
          </tr>
  <?php
          $total--;
          }
        }
  ?>
  </tbody>
  </table>



</body>
</html>
