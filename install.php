<?php
require_once ('config.php');


if(isset($_POST['user'])){
  $user = $_POST['user'];
  $pass = encrypt($_POST['pass']);


  $out = array();
  $sql = "INSERT INTO tbl_users (username, password, isadmin)
        VALUES ('$user', '$pass', '1')";

  if ($conn->query($sql) === TRUE) {
    $out['callback'] = "success";
    $out['passhashed'] = $pass;
  } else {
    $out['callback'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
  echo json_encode($out);
  exit();
}

function encrypt($pass){
  global $setting;
  $hash = md5($pass.$setting['salt']);
  return $hash;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title>Change_me</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">
  <link rel="stylesheet" href="asset/css/styles.css">
  <link rel="stylesheet" href="asset/css/font-awesome/all.css">
  <script src="jquery-3.5.1.min.js"></script>
  <style>
    body,html{
      color: #000000;
      background-color: #F5F5F5;
    }
    .container{
      padding: 20px 20px;
      text-align: center;
      background-color: #FFFFFF;
      width: 300px;
      margin: auto;
    }
    input{
      width: 180px;
      height: 30px;
    }
    button{
      padding: 5px;
      /*width: 80px;*/
    }
    .success-font{
      font-size: 14px;
    }

    .exclamation{
      background-color: #C62828;
      color: #FFFFFF;
      padding: 5px;
      border-radius: 5px;
    }

  </style>
</head>

<body>

<div class="container">
  <h3>نصب اسکریپت</h3><br>
  <p>نام کاربری مدیر:</p>
  <input type="text" id="username" class="ltr" autocomplete="off" placeholder=""><br><br>
  <p>رمز عبور:</p>
  <input type="text" id="password" class="ltr" autocomplete="off" placeholder=""><br><br>
  <button id="install"><i class="fa fa-check"></i> انجام بده</button><br><br>
  <span id="successful" class="hidden success-font rtl">
    <b><p>کاربر مدیر با موفقیت اضافه شد</p></b>
    <b><p>نام کاربری:</p></b>
    <p id="userName"></p>
    <b><p>رمز عبور انتخابی:</p></b>
    <p id="passWord"></p>
    <b><p>رمز عبور هش شده:</p></b>
    <p id="passWordHash"></p>
    <p class="exclamation"><i class="fa fa-exclamation-triangle"></i>اکنون فایل install.php را می‌توانید حذف نمائید</p>

  </span>


</div>

<script>
  $(function (){
    $("#install").on('click', function (){
      var username = $("#username").val();
      var password = $("#password").val();
      var unhashed_password = $("#password").val();;
      // alert(username);
            $.ajax('install.php', {
                    type: 'post',
                    dataType: 'json',
                    data: {
                      user: username,
                      pass: password
                    },
                    success: function (data){
                      console.log(data);
                      if(data['callback'] == 'success'){
                        $("#successful").removeClass('hidden');
                        $("#userName").html(username);
                        $("#passWord").html(password);
                        $("#passWordHash").html(data['passhashed']);
                      }
                    }
                  });

    });
  });
</script>

</body>
</html>
