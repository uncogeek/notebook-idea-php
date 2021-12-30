<?php
require_once ('config.php');
require_once ('core.php');

session_start();
if(isset($_GET['method']) && $_GET['method'] == "logout"){
  session_destroy();
  header('Location: login.php');
}

if(isset($_SESSION['login']) and $_SESSION['login'] == 'yes'){
  header('Location: index.php');
}


if(isset($_POST['username'])){
  require_once('config.php');
  global $conn;

  $username= $_POST['username'];
  $password = $_POST['password'];
  $pword = "";

  $out = array();
  $sql = "SELECT * FROM tbl_users WHERE username='$username'";
  $result = mysqli_query($conn, $sql);



  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $uname = $row["username"];
      $pword = $row["password"];
      $isadmin = $row["isadmin"];
    }
  }
  global $setting;

  if(encryptPassword($password) == $pword){
    $_SESSION["username"] = $username;
    $_SESSION["isadmin"] = $isadmin;
    $_SESSION["login"] = "yes";
    header('Location: index.php');
  } else {
//    echo "<script>alert(\"failed\")</script>";
    echo 'failed';
  }


  $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <link rel="stylesheet" href="css/style.css">
  <script src="asset/js/jquery-3.5.1.min.js"></script>

  <style>
    .bg{
      background-color: #F5F5F5;
    }
    @font-face {
      font-family: IRANSans;
      font-style: normal;
      font-weight: 300;
    url('IRANSansWeb_Light.ttf') format('truetype');
    }
    body{
      direction: rtl;
      font-family: "B Nazanin", IRANSans;
      background-color: #3E2723;
    }
    .container{
      background-color: #FFFFFF;
      width: 360px;
      border: 1px solid black;
      border-radius: 5px;
      margin: auto;
      height: 450px;
      padding-bottom: 10px;
    }
    .title{
      background-color: #12AFA8;
      border-radius: 5px 5px 0 0 ;
      color: #FFFFFF;
      text-align: center;
      vertical-align: middle;
      padding: 15px;
      font-size: 20px;

    }
    img{
      margin-top:  8px;
      border-radius: 0px;
    }
    input[type=text], input[type=password] {
      width: 50%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      border-radius: 5px;
    }
    input:focus{
      border-radius: 5px;
      outline: none;
    }

    input:hover{
      border-radius: 5px;
      outline: none;
      border: 1px solid #01579B;
    }
    .tac{
      text-align: center;
    }
    .tar{
      text-align: right;
    }
    .mt-5{
      margin-top:  8px;
    }
    .btn-blue {
      font-family: IRANSans;
      height: 50px;
      width: 200px;
      background-color: #7CB342;
      color: #fff;
      padding: 5px 15px;
      cursor: pointer;
      border: 1px solid #59f;
      border-radius: 5px;
      font-weight: bold;
      font-size: 16px;
    }
    .btn-blue:hover {
      border: 1px solid #59f;
    }
    ::-moz-placeholder {
      font-family: "IRANSans", 'iransans light', 'B Nazanin', "B Koodak", "droid" , sans-serif;
      font-size: 16px;
    }

  </style>
</head>

<body>

<div class="container tac">
  <form method="post" name="login" action="login.php">
    <div class="title"><b>ورود</b></div>
    <div><img src="asset/images/avatar2.png" width="80px" style="pointer-events: none;" class="tac"> </div>
    <div class="tac mt-5">نام کاربری:</div>
    <input type="text" class="tac" placeholder="" id="username" name="username" autocomplete="off" required>
    <div class="tac mt-5">رمز عبور:</div>
    <input type="password" class="tac" placeholder="" id="password" name="password" autocomplete="off" required>
    <input type="submit" value="ورود" class="btn-blue">
  </form>




</div>

<script>



</script>

</body>
</html>