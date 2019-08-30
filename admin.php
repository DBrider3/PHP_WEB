<?php
// session 검증 부분
session_start();
$is_logged = $_SESSION['is_logged'];
if($is_logged=='YES') {
  $user_id = $_SESSION['id'];
  if ($user_id == 'admin' && $_SESSION['is_admin']==1){
    $message = $user_id . ' , 관리자 로그인 했습니다.';
    // header("Location: admin.php");
  }
  else{
    $message = $user_id . ' 님, 로그인 했습니다.';
    header("Location: index.php");
  }
}
else echo "<script>location.replace('/member/login.php');</script>";

require_once $_SERVER['DOCUMENT_ROOT'].'/head.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/dbcon.php';



?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title></title>
</head>
<body>

<table style="width:1000px;height:50px;border:5px #CCCCCC solid;">
    <tr>
        <td align="center" valign="middle" colspan="3" style="font-zise:15px;font-weight:bold;">
        관리자 페이지 입니다.
        </td>
    </tr>
    <tr>
        <td align="center" valign="middle" style="font-size:12px;"><a href="/admin/admin_board_list.php">게시판목록</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="/admin/admin_member_list.php">회원목록</a></td>
        <td align="center" valign="middle" style="font-size:12px;"><a href="/member/logout.php">로그아웃</a></td>
    </tr>
</table>


</body>
</html>
