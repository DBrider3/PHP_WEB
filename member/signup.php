<!DOCTYPE html>
<html>
<style>
body {font-family:Arial,Helvetica,sans-serif;}
* { box-sizing:border-box}

input[type=text], input[type=password] {
    width: 100%;
    padding:15px;
    margin:5px 0 22px 0;
    display : inline-block;
    border:none;
    background:#f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
    backgorund-color:#ddd;
    outline:none;
}

hr {
    border: 1px solid #f1f1f1;
    margin-bottom:25px;
}

button {
    background-color:#4CAF50;
    color:white;
    padding:14px;20px;
    margin:8px 0;
    border:none;
    cursor:pointer;
    width:100%;
    opacity:0.9;
}

.cancelbtn {
    padding:14px 20px;
    background-color:#f44336;
}

.cancelbtn, .signupbtn {
    float:left;
    width:50%;
}

.container {
    padding:16px;
}

.clearfix::after {
    content:"";
    clear:both;
    display:table;
}

@media screen and (max-width:300px) {
    .cancelbtn, .signupbtn {
        width:100%;
    }
}
</style>
<head>
    <title>Dominic's WEB ★</title>
    <meta charset="utf-8" >
</head>
<body>
  <form action="/member/setup_signup.php" style="border:1px solid #ccc" method="POST">
      <div class="container">
          <h1>회원가입</h1>
          <p>회원가입을 위해 빈칸을 채워 주세요.</p>
          <hr>

          <label for="id"><b>*ID</b></label>
          <input type="text" placeholder="Enter ID" name="user_id" required>

          <label for="psw"><b>*Password</b></label>
          <input type="password" placeholder="Enter Password" name="user_pw" required>

          <label for="psw_chk"><b>*Password_Check</b></label>
          <input type="password" placeholder="Enter Password" name="user_pw2" required>

          <label for="user_email"><b>Email</b></label>
          <input type="text" placeholder="Enter email" name="user_email" required>

          <p>* 표시된 부분은 필수 입력 사항입니다.</p>
          <div class="clearfix">
              <button type="submit" class="signupbtn">회원가입</button>
              <button type="button" class="cancelbtn" onclick="location.href='../index.php'">취소</button>
          </div>
      </div>
</form>
</body>
</html>
