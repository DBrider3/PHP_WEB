<!DOCTYPE>
<?php
// 1. 공통
require_once $_SERVER['DOCUMENT_ROOT'].'/admin.php';
// db연결
require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';

$connection= new mysqli($hn,$un,$pw,$db);

if($connection->connect_error) die($connection->connect_error);
// db검증 필수 사항

extract($_GET); // 이것을 이용해서 post 또는 get 방식으로 전달된 내용을 php변수에 담아냄

$query = "select id, pw, email from users where idx =$idx";
$result = $connection->query($query);
$rows = mysqli_fetch_assoc($result);

$id = $rows['id'];
$pw = $rows['pw'];
$email = $rows['email'];

?>


<html>
<head>

<style>

table.table2{
  border-collapse: separate;
  border-spacing: 10px;
  text-align: left;
  line-height: 1.5.;
  border-top: 1px solid #ccc;
  margin : 30px 20px;
}
table.table2 tr {
  width: 50px;
  padding: 10px;
  font-weight: bold;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
}
table.table2 td {
  width: 100px;
  padding: 10px;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
}

</style>
</head>
<body>

<form method = "post" action = "./admin_member_modify_ok.php">
        <table  style="padding-top:50px" align = center width=800 border=0 cellpadding=2 >
                <tr>
                <td height=20 align= center bgcolor=#ccc><font color=white> 회원정보수정</font></td>
                </tr>
                <tr>
                <td bgcolor=white>
                <table class = "table2">
                        <tr>
                        <td>아이디</td>
                        <td><input type="hidden" name="id" value="<?=$id?>"><?=$id?></td>
                        </tr>

                        <tr>
                        <td>비밀번호</td>
                        <td><input type = password name = pw size=10></td>
                        </tr>

                        <tr>
                        <td>이메일</td>
                        <td><input type = text name = email size=20></td>
                        </tr>

                        </table>

                        <center>
                          <input type="hidden" name="idx" value="<?=$idx?>">
                        <input type = "submit" value="변경">
                        </center>
                </td>
                </tr>
        </table>
        </form>
</body>
</html>
