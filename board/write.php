<!DOCTYPE>
<?php
session_start();
$is_logged = $_SESSION['is_logged'];
if($is_logged=='YES') {
  $user_id = $_SESSION['id'];
  $message = $user_id . ' 님, 로그인 했습니다.';
}
else echo "<script>location.replace('/member/login.php');</script>";
?>


<html>
<head>
  <TITLE>Dominic's WEB ★</TITLE>

  <meta charset="utf-8">
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
<p></p>
<p></p>

<form method = "post" action = "write_action.php" enctype="multipart/form-data">
        <table  style="padding-top:50px" align = center width=800 border=0 cellpadding=2 >
                <tr>
                <td height=20 align= center bgcolor=#ccc><font color=white> 글쓰기</font></td>
                </tr>
                <tr>
                <td bgcolor=white>
                <table class = "table2">
                        <tr>
                        <td>작성자</td>
                        <td><input type="hidden" name="name" value="<?=$user_id?>"><?=$user_id?></td>
                        </tr>

                        <tr>
                        <td>제목</td>
                        <td><input type = text name = title size=60></td>
                        </tr>

                        <tr>
                        <td>내용</td>
                        <td><textarea name = content cols=85 rows=15></textarea></td>
                        </tr>

                        <tr>
                        <td>첨부파일</td>
                        <td><input type="file" value="1"name="b_file"/></td>
                        </tr>

                        </table>

                        <center>
                        <input type = "submit" value="작성">
                        </center>
                </td>
                </tr>
        </table>
        </form>
</body>
</html>
