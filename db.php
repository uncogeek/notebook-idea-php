<?php


if(isset($_POST['call']) && $_POST['call'] == 'login'){
  require_once('config.php');
  global $conn;

  $username= $_POST['username'];
  $password = $_POST['password'];
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

  if($password == $pword){
    $out['response'] = "logined";

    $_SESSION["username"] = $username;
    $_SESSION["isadmin"] = $isadmin;
    $_SESSION["login"] = 'yes';
    $out['login'] = "yes";

  } else {
    $out['response'] = "failed";
    $_SESSION["login"] = 'no';
  }


  $conn->close();
  echo json_encode($out);

}



if(isset($_POST['call']) && $_POST['call'] == 'deletecategory'){
  require_once('config.php');
  $id = $_POST['id'];
  $out = array();
  $sql = "DELETE FROM tbl_idea WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    $out['updatetable'] = "success";
  } else {
    $out['updatetable'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
  echo json_encode($out);
}




if(isset($_POST['call']) && $_POST['call'] == 'saveTableConfig'){
  require_once('config.php');
  $order = $_POST['order'];
  $title = $_POST['title'];
  $value= $_POST['value'];
  $color = $_POST['color'];
  $icon = $_POST['icon'];
  $id = $_POST['id'];
  $out = array();
  $sql = "UPDATE tbl_idea_category SET category_id='$order', category_list='$title', category_value='$value', category_icon='$icon', category_color='$color' WHERE id='$id'";

  if ($conn->query($sql) === TRUE) {
    $out['updatetable'] = "success";
  } else {
    $out['updatetable'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close();
  echo json_encode($out);
}


if(isset($_POST['call']) && $_POST['call'] == 'newlink'){
  require_once('config.php');
  $title = $_POST['link_title'];
//  $address = $_POST['link_address'];
  $categoty = $_POST['category_opt'];
  $out = array();
  $sql = "INSERT INTO tbl_idea (link_name,  category) VALUES ('$title', '$categoty' ) ";

  if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    $out['insertnewlink'] = "success";
    $out['id'] = $last_id;
//    $out['link'] = $address;

  } else {
    $out['insertnewlink'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  echo json_encode($out);
}


if(isset($_POST['call']) && $_POST['call'] == 'deleteLink'){
  require_once('config.php');
  $id = $_POST['link_id'];
  $out = array();
  $sql = "DELETE FROM tbl_idea WHERE id='$id' ";

  if ($conn->query($sql) === TRUE) {
    $out['deletelink'] = "success";
  } else {
    $out['deletelink'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  echo json_encode($out);
}

if(isset($_POST['call']) && $_POST['call'] == 'updateLinkEdit'){
  require_once('config.php');

  $link_title =$_POST['link_title'];
//  $link_address =$_POST['link_address'];
  $id = $_POST['link_id'];

  $out = array();
  $sql = "UPDATE tbl_idea SET link_name='$link_title' WHERE id='$id' ";

  if ($conn->query($sql) === TRUE) {
    $out['updatelink'] = "success";
  } else {
    $out['updatelink'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  echo json_encode($out);


}


if(isset($_POST['call']) && $_POST['call'] == 'update'){
  $page_title = $_POST['page_title'];
  $btn_link_title = $_POST['btn_link_title'];
  $btn_link_color = $_POST['btn_link_color'];
  $bg_nav_menu = $_POST['bg_nav_menu'];
  updateConfig($page_title, $btn_link_title, $btn_link_color, $bg_nav_menu);
}

if(isset($_POST['call']) && $_POST['call'] == 'insertnav'){
  $nav_icon = $_POST['nav_icon'];
  $nav_title = $_POST['nav_title'];
  $nav_link = $_POST['nav_link'];
  $nav_order = $_POST['nav_order'];
  $nav_target = $_POST['nav_target'];
  insertNavMenu($nav_icon, $nav_title, $nav_link, $nav_order, $nav_target);
}

function insertNavMenu($nav_icon, $nav_title, $nav_link, $nav_order, $nav_target){
  require_once('config.php');
  $out = array();
  $sql = "INSERT INTO tbl_nav_menu (item_title, item_link, item_icon, item_order, target)
        VALUES ('$nav_title', '$nav_link', '$nav_icon', '$nav_order', '$nav_target' )";

  if ($conn->query($sql) === TRUE) {
    $out['insertnav'] = "success";
  } else {
    $out['insertnav'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  echo json_encode($out);
}




if(isset($_POST['category_id'])){
  $category_id = $_POST['category_id'];
  $category_title = $_POST['category_title'];
  $category_value = $_POST['category_value'];
  $category_icon = $_POST['category_icon'];
  $category_color = $_POST['category_color'];
  insertDb($category_id, $category_title, $category_value, $category_icon, $category_color);
}


function updateConfig($page_title, $btn_link_title, $btn_link_color, $bg_nav_menu){
  require_once('config.php');
  $out = array();
  $sql = "UPDATE tbl_config SET page_title='$page_title', button_submit_title='$btn_link_title',
                      color_button_submit='$btn_link_color', navigation_color_bg='$bg_nav_menu' WHERE id='1'";

  if ($conn->query($sql) === TRUE) {
    $out['update'] = "success";
  } else {
    $out['update'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  echo json_encode($out);

}

function insertDb($category_id, $category_title , $category_value, $category_icon, $category_color){
  require_once('config.php');
  $out = array();
  $sql = "INSERT INTO tbl_idea_category (category_id, category_list, category_value, category_icon, category_color)
        VALUES ('$category_id', '$category_title', '$category_value', '$category_icon' , '$category_color')";

  if ($conn->query($sql) === TRUE) {
    $out['insert'] = "success";
  } else {
    $out['insert'] = "failed";
    $out['error'] = "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
  echo json_encode($out);
}