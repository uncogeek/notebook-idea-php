<?php


$q = array();

$totalBoxes = $total - 1;
for($i = $totalBoxes; $i >= 0; $i--){
  divBoxHeader();
  divBoxContent($title_name[$i], $title_colors[$i], $title_icon[$i]);
  echo "<div class='content-links  $category_value[$i]' id='box$title_order[$i]' >";
  querySHow($category_value[$i]);
  echo "</div>";
  divBoxFooter();

}

function divBoxHeader(){
  echo"
  <div class='nohigh box-a inline box'>
  ";

}



function divBoxContent($title, $color, $icon){
  global $category, $c;
echo "
    <div class='nohigh title-box ltr' style='background-color: $color;'><i class='$icon mr-5' ></i><b>$title</b></div>
";

}

function divBoxFooter(){
  echo "</div>";

}

