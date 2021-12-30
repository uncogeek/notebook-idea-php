<?php

require_once ('core.php');
require_once ('header.php')


?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
  <script src="jquery-3.5.1.min.js"></script>

<!--  COLOR PICKER-->
  <script src="asset/js/huebee.pkgd.min.js"></script>
  <link rel="stylesheet" href="asset/css/huebee.min.css" />
  <link rel="stylesheet" href="asset/css/styles.css">
  <link rel="stylesheet" href="asset/css/base.css">
<!--FONT AWESOME LOAD-->
  <link rel="stylesheet" href="asset/css/font-awesome/all.css" />


  <!--  FONT AWESOME ICON PICKER-->
  <link rel="stylesheet" type="text/css" href="asset/css/fontpicker/fontawesome-browser.css">
  <link rel="stylesheet" href="asset/css/font-awesome/all.css">
  <script src="asset/js/fontpicker/fontawesome-browser.js"></script>

  <style>
    body{
      overflow-x: auto;
      background-color: #F5F5F5;
      width:  100%;
    }
    input{
      width: 160px;
      height: 30px;
      font-size: 9pt;
      background-color: #FFFFFF;
    }
    .colorpickerplugin{
      width: 120px;height: 20px;border-radius: 5px;border: 0px none;text-align: center;outline: none;
    }
    .td{
      width: 10px;
    }
    .hidden{
      /*display: none;*/
      visibility: hidden;
    }
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .box{
      width: max-content%;
      background-color: #FFFFFF;
      border-radius: 5px;
      float: right;
      margin: 10px;
      padding: 10px;
      text-align: center
    }

    .mt8{
      margin-top: 8px;
    }
    .rtl {
      direction: rtl;
    }
  </style>
</head>
<body>


<!--<div class="box rtl">-->
<!--  <h3>MD5 hash maker</h3>-->
<!---->
<!--  <input type="text" width="80" id="input_hash" placeholder="Your key" autocomplete="off" "><br><br>-->
<!--  <input type="text" width="80" id="salt" placeholder="SALT" autocomplete="off"><br><br>-->
<!--  <input type="text" width="80" id="maked_hash" placeholder="MD5 + SALT" autocomplete="off"><br><br>-->
<!---->
<!--</div>-->

<div class="box rtl">
  <h3>ساخت دسته بندی جدید</h3>

  <input type="text" width="80" id="category-id" placeholder="ردیف" autocomplete="off"><br>
  <input type="text" class="mt8" width="80" id="category-title" placeholder="عنوان دسته بندی" autocomplete="off"><br>
  <input type="text" class="mt8" width="80" id="category-value" placeholder="مقدار فیلتر" autocomplete="off"><br>
  <input name="color" class="color-picker colorpickerplugin mt8" id="category-color" value="select color" style="background-color: #00B92E;height: 30px"/><br>
  <input type="text" placeholder="Select icon" class="mt8" id="icon-select" onchange="previewIconSelected()" data-fa-browser   />
  <i class="fa fa-dragon" id="icon-preview"></i>
  <input type="hidden" id="value-icon">


  <br><input type="button" class="mt8 btnlogin" style="width: 120px;" value="اضافه کردن" onclick="insertCategory()">


</div>


<div class="box rtl">
  <h3>تنظیمات</h3>
  <p>عنون صفحات</p>
  <input type="text" id="config_page_title" value="<?=$config[1]?>"><br>
  <p>عنوان دکمه ثبت لینک جدید</p>
  <input type="text"  id="btnLinkTitle" value="<?=$config['button_submit_title']?>" autocomplete="off" ><br>
  <p>رنگ پس زمینه دکمه ثبت لینک جدید</p>
  <input name="color" class="color-picker2 colorpickerplugin" id="btnLinkColor"  value="<?=$config['color_button_submit']?>" style="background-color: #00B92E;height: 30px" autocomplete="off" /><br>
  <p>پس زمینه منو بار</p>
  <input name="color" class="color-picker3 colorpickerplugin x" id="navMenuBg"  value="<?=$config['navigation_color_bg']?>" style="background-color: #00B92E; height: 30px"/><br>
  <input type="button" class="mt8 btnlogin" style="width: 120px;" value="ذخیره" id="saveBtn" onclick="saveConfig()">

</div>

<div class="box rtl">
  <h3>اضافه کردن آیتم به منو</h3>
  <input type="text" placeholder="انتخاب آیکون" id="icon-select2" onchange="previewIconSelected2()" data-fa-browser  autocomplete="off" />
  <i class="fa fa-globe-americas" id="icon-preview2"autocomplete="off"></i>
  <input class="mt8" type="hidden" id="value-icon2"autocomplete="off"><br>
  <input class="mt8" type="text" placeholder="عنوان" id="navTitle"autocomplete="off"><br>
  <input class="mt8" type="text" placeholder="لینک" id="navLink"autocomplete="off"><br>
  <input class="mt8" type="text" placeholder="تارگت" id="navTarget"autocomplete="off"><br>
  <input class="mt8" type="text" placeholder="شماره جایگاه" id="navOrder"autocomplete="off"><br>
  <input class="mt8 btnlogin" type="button" style="width: 120px;" value="اضافه کردن" id="insertNav" onclick="saveNavMenu()"><br>
</div>
<div class="box">
  <h2>دسته بندی ها</h2>
  <h3> تنظیمات لیست دسته بندی  </h3>
  <table style="text-align: center; min-width: 40%;" id="tbl" class="hidden" >
    <div class="loader" id="loader"></div>
    <th>ترتیب</th>
    <th>دسته بندی</th>
    <th>مقدار</th>
    <th>رنگ</th>
    <th>آیکون</th>
    <th>حذف</th>
    <?=showCategoryItemsOrder()?>
  </table>

  <br><input type="button" class="btnlogin" type="button" style="width: 120px;" value="ذخیره" onclick="saveOrderOfCategories()">
</div>


<div style="clear: both"></div>

</body>
</html>


<script>


 // salt md5 maker
 $("#input_hash").on('keyup', function () {
   var inputkey = $('#input_hash').val();
   console.log($("#input_hash").val());
   var salt = $('#salt').val();
   if($('#input_hash').val().length >= 1){
     $.ajax('tools.php', {
       type: 'post',
       dataType: 'json',
       data: {
         to_hash: inputkey,
         salt: salt,
         call: 'hash'
       },
       success: function (data){
         if(data['response'] == 'ok'){
           console.log(data['hashkamed']);
           $('#maked_hash').val(data['hashkamed']);
         }
       }
     });
   }
 });




  function mdfSaltMaker(){


  }

  function deleteCategory($id){

    var value = $id;

    if (confirm('دسته بندی حذف شود؟')) {
      $.ajax('db.php', {
        type: 'post',
        dataType: 'json',
        data: {
          id: value,
          call: 'deletecategory'
        },
        success: function (data){
          if(data['deletecategoty'] == 'success'){
            alert('حذف شد');
            console.log('success');
          }
        }
      });
    }
  }

  function saveOrderOfCategories(){
    var totlacat = $('#totalcat').val();
    var index = totlacat;
    for(var i = totlacat; i > 0; i--){
      if (i == 1){
        alert('با موفقیت بروزرسانی شد');
      }
      var tbl_order = $("#tbl_order" + i).val();
      var tbl_title = $("#tbl_title" + i).val();
      var tbl_value = $("#tbl_value" + i).val();
      var tbl_color = $("#tbl_color" + i).val();
      var tbl_icon  = $("#tbl_icon" + i).val();
      var tbl_id  = $("#row" + i).val();

      $.ajax('db.php', {
        type: 'post',
        dataType: 'json',
        data: {
          order : tbl_order,
          title : tbl_title,
          value : tbl_value,
          color : tbl_color,
          icon : tbl_icon,
          id : tbl_id,
          call: 'saveTableConfig'
        },
        success: function (data){
          if(data['updatetable'] == 'success'){

            console.log('success');
            index = i;
          }
        }
      });
    }
  }

  function saveNavMenu(){
    var nav_icon = $('#value-icon2').val();
    var nav_title = $('#navTitle').val();
    var nav_link = $('#navLink').val();
    var nav_order = $('#navOrder').val();
    var nav_target = $('#navTarget').val();
    $.ajax('db.php', {
      type: 'post',
      dataType: 'json',
      data: {
        nav_icon: nav_icon,
        nav_title: nav_title,
        nav_link: nav_link,
        nav_order: nav_order,
        nav_target: nav_target,
        call: 'insertnav'
      },
      success: function (data){
        if(data['insertnav'] == 'success'){
          alert('با موفقیت ثبت شد');
          console.log('insertnav success : ' + nav_icon);
        }
      }
    });
  }


  function saveConfig(){
    var page_title = $('#config_page_title').val();
    var btn_link_title = $('#btnLinkTitle').val();
    var btn_link_color = $('#btnLinkColor').val();
    var bg_nav_menu = $('#navMenuBg').val();
    $.ajax('db.php', {
      type: 'post',
      dataType: 'json',
      data: {
        page_title: page_title,
        btn_link_title: btn_link_title,
        btn_link_color: btn_link_color,
        bg_nav_menu: bg_nav_menu,
        call: 'update'
      },
      success: function (data){
        if(data['update'] == 'success'){
          alert('تنظیمات با موفقیت بروز شد');
          console.log('config updated : ' + page_title);
        }
      }
    });


  }


  function previewIconSelected(){
    // alert(document.getElementById('icon-select').value);
    var iconSelected = $('#icon-select').val();
    console.log('icon selected: ' + iconSelected);
    var iconPreview = $('#icon-preview');
    $('#icon-preview').removeClass();
    console.log('removed previous icon class');
    $('#icon-preview').addClass(iconSelected);
    console.log('preview updated: ' + iconSelected);
    $('#value-icon').val(iconSelected);
    // alert($('#value-icon').val());
  }

  function previewIconSelected2(){
    var iconSelected2 = $('#icon-select2').val();
    var iconPreview = $('#icon-preview2');
    $('#icon-preview2').removeClass();
    $('#icon-preview2').addClass(iconSelected2);
    $('#value-icon2').val(iconSelected2);
  }

  $(function (){


  });

  function setCodeColor(){
    var color = $('#category-color-select').val();
    $('#category-color-code').val(color);
  }

  // function addBox(){
  //   var boxTitle =  $('#box-title').val();
  //   var boxColor =  $('#box-color').val();
  //   var boxPosition =  $('#box-position').val();
  //   console.log('Title: ' + boxTitle);
  //   console.log('Color: ' + boxColor);
  //   console.log('Position: ' + boxPosition);
  // }

  function insertCategory(){
    var category_id    =  $("#category-id").val();
    var category_title =  $("#category-title").val();
    var category_value =  $("#category-value").val();
    var category_icon =   $("#value-icon").val();
    var category_color =   $("#category-color").val();

    $.ajax('db.php', {
      type: 'post',
      dataType: 'json',
      data: {
        category_id: category_id,
        category_title: category_title,
        category_value: category_value,
        category_icon: category_icon,
        category_color: category_color
      },
      success: function (data){
          if(data['insert'] == 'success'){
            console.log('xx');
            alert('با موفقیت ثبت شد');
            $("#category-id").val('');
            $("#category-title").val('');
            $("#category-value").val('');
            $("#category-icon").val('');
            $("#category_color").val('#F5F5F5');
            console.log('insert : ' + data);
          }
      }
    });

  }


  $(function (){
    colorPickerPallete("color-picker");
    colorPickerPallete("color-picker2");
    colorPickerPallete("color-picker3");
    var totlacat = $('#totalcat').val();



    for ( itotal = totlacat; itotal > 0; itotal--){
      var tmp = 'clp' + itotal;
      colorPickerPallete(tmp);
      console.log(tmp);
      $('#tbl').removeClass('hidden');
      $('#loader').hide();
    }

    // colorPickerPallete("color-picker-table");
    // var classColorPicker = $('.colorpicker).val();
    // alert(xd.match(/^#(\w+)/)[1]); // 1234
    // alert(xd.match(/^#(\w+)/)[1]); // 1234
  });
  $(window).bind("load", function() {
      //
  });


    // COLOR PICKER START AND CONFIG
  function colorPickerPallete($class){
    var colorPicker = new Huebee( '.' + $class , {
      // the number of hues
      hues: 16,
      // the first hue
      hue0: 0,
      // the number of shades
      shades: 10,
      // the number of sets of saturation
      saturations: 2,
      // or "hex", "hsl"
      notation: 'hex',
      // notation: 'shortHex',
      // applies color to text
      setText: true,
      // applies color to background
      setBGColor: true,
      // shows the color picker on init
      staticOpen: false,
      // additional CSS class(es)
      className: ''
    });
  }




  // FONT AWESOME ICON PICKER START
  $(function($) {
    $.fabrowser();
  });


</script>

