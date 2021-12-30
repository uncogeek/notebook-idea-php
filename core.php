<?php
require_once('config.php');

function encryptPassword($password){
  global $setting;
  return md5($password . $setting['salt']);
}

function hashMaker($input, $salt){
  return md5($input . $salt);
}



function autenication(){
  if(!isset($_SESSION['login']) and $_SESSION['login'] != 'yes'){
    header('Location: login.php');
  }
}

$query_select_category = "SELECT category_id, category_list, category_value, category_icon, category_color FROM tbl_idea_category ORDER BY category_id DESC";
$list_category = $conn->query($query_select_category);
$tmp = mysqli_fetch_array($conn->query("SELECT count(*) FROM tbl_idea_category"));
$total = $tmp[0];

// CONFIG
$config = mysqli_fetch_array($conn->query("SELECT * FROM tbl_config"));


if ($list_category->num_rows > 0) {
//  $count = $list_category->num_rows;
  while($row = $list_category->fetch_assoc()) {
//    echo "id: " . $row["category_id"]. " - Name: " . $row["category_list"]. " " . $row["category_value"]. $row["category_icon"]. "<br>";
//    for($i = $total; $i >=0; $i--){
      $title_name[] = $row["category_list"];
      $category_value[]                 = $row["category_value"];
      $title_icon[]                  = $row["category_icon"];
      $title_colors[]                = $row["category_color"];
      $title_order[]                = $row["category_id"];

//    }
  }
}

if(isset($_POST['name'])) {
  $opt = $_POST['options'];
  queryInsert($opt);
}

function showListCategory(){
  global $total, $title_name, $category_value;
  for($i = $total - 1; $i >= 0; $i--){
    echo "<option class='rtl' value=\"$category_value[$i]\">$title_name[$i]</option>";
  }
}

function showHeaderNavItems(){
  global $conn;
  $query_nav_items = "SELECT * FROM tbl_nav_menu ORDER BY item_order ASC";
  $arr = array();
  $result = mysqli_query($conn, $query_nav_items);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $title = $row["item_title"];
      $link = $row["item_link"];
      $icon = $row["item_icon"];
      $order = $row["item_order"];
      $target = $row["target"];
      echo "<a href=\"$link\" target=\"$target\"><div class=\"nohigh header-1\"><i class=\"$icon\"></i> $title </div> </a>";
    }
  }



}





function queryInsert($opt){
  global $conn;
  $link_name = $_POST['name'];
  $link_address = $_POST['address'];
  $link_category= $opt;
  $insert = "INSERT INTO tbl_idea (link_name, link_address, category)
    VALUES('$link_name','$link_address','$link_category')";
  mysqli_query($conn, $insert);
}

function querySHow($category){
  global $conn;
  $arr = array();
  $sql = "SELECT id, link_name, link_address FROM tbl_idea WHERE category='$category' ORDER BY id desc";
  $result = mysqli_query($conn, $sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $id_row = $row["id"];
      echo  '
            <div class="nohigh ' .$id_row. '" style="">
                <span class="inline" style="height: max-content;float: right; width: 80%">
                    <span hidden id="'. $id_row .'"></span>
                    <li onclick="popup(this.innerHTML)" id="title'. $id_row . '"  class="limit item-idea pre-wrap li-linkdooni inline lnk'. $id_row . '">' . $row["link_name"] . '</li>
               </span>
                <span class="inline" style="float: left; width: 20% ">
                    <li class="li-linkdooni inline operate operator-edit" id="' .$id_row .'" style="" onclick="editLink(this.id)"><i class="fa fa-pencil-alt"></i></li>
                    <li class="li-linkdooni inline operate operator-edit" id="' .$id_row .'" style="" onclick="deleteLink(this.id)"><i class="fa fa-trash-alt"></i></li>
                </span>
            </div>
              
        
        ';
    }
  } else {
    echo "<br>";
    echo '<p style="color:#D7CCC8">empty</p>';
  }

}

function showResult($category){
  global $conn;
  querySHow($category);
}


function showCategoryItemsOrder(){

  global $conn;
  $query = "SELECT * FROM tbl_idea_category ORDER BY category_id ASC";
  $arr = array();
  $result = mysqli_query($conn, $query);
  $rows = mysqli_num_rows($result);
  $i = 1;
  echo "<input type=\"hidden\" id='totalcat' value=\"$rows\"> ";
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $order = $row["category_id"];
      $title = $row["category_list"];
      $value = $row["category_value"];
      $icon = $row["category_icon"];
      $color = $row["category_color"];
      $id = $row["id"];
      echo "
      <tr>
        <td><input type=\"text\" id='tbl_order$i' class='' name=\"order\" width=\"2\" value=\"$order\" style=\"width: 40px;\"></td>
        <td><input type=\"text\" id='tbl_title$i' class='' name=\"title\" value=\"$title\" style=\"width: 90px;\"></td>
        <td><input type=\"text\" id='tbl_value$i' class='' name=\"value\" value=\"$value\" style=\"width: 80px;\"></td>
        <td><input type=\"text\" id='tbl_color$i' class='color-picker-table123 clp$i'  name=\"color\" value=\"$color\" style=\"width: 80px;\"></td>
        <td><input type=\"text\" id='tbl_icon$i' class='' name=\"icon\"  value=\"$icon\" style=\"width: 110px;\"></td>
        <td class='hidden'><input type=\"hidden\" id='row$i' class='' name=\"icon\"  value=\"$id\" style=\"width: 110px;\"></td>
        <td class=''><i class='fa fa-trash-alt' id='$id' onclick='deleteCategory(this.id)'></i></td>
      </tr>
      
      ";
      $i++;

    }
  }

}

?>