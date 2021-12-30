<!DOCTYPE html>
<html lang="fa">
<?php
include_once 'core.php';
session_start();

autenication();



?>
<head>
  <meta name="description" content="Webpage description goes here" />
  <meta charset="utf-8">
  <title><?=$config['page_title']?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="">

  <link rel="stylesheet" href="asset/css/styles.css">
  <link rel="stylesheet" href="asset/css/base.css">
  <link rel="stylesheet" href="asset/css/font-awesome/all.css">
  <script src="asset/js/jquery-3.5.1.min.js"></script>
  <link href="asset/css/attention.css" rel="stylesheet">
  <script src="ckeditor/ckeditor.js"></script>

  <style>

  </style>



</head>

<body>
    
    <div class="cm-spinner" id="spinner-loading"></div>

    <div class="form-popup" id="myForm">
  <form action="/action_page.php" class="form-container">
     <h2 class="tac header-title-pages "></h2><span class="closeBtn" onclick="closeForm()">X</span>
    <div id="zex" class="zex"></div>
        
    
  </form>
</div>
    
<script src="asset/js/attention.js"></script>
    <div class="" id="turn-shadow-bg">
<div id="xxxx" style="display: none"></div>
<?php require_once ('header.php') ?>
<div class="tac" id="div3">
  <div class="txt02">


      <div class="inline" style="width: 100%;"">
        <div class="form-group inline" style="width: 63%;">
          <textarea class="form-control inline" placeholder="ایده..." id="linkTitle"   name="name" row="2"  autofocus autocomplete="off"></textarea>
<!--          <input class="form-control tac ltr" placeholder="آدرس لینک" name="linkAddress" id="linkAddress" type="text"  value="" autocomplete="off">-->
          <input type="hidden" id="hiddenIdLink" value="" >
        </div>
        <div class="block">
          <select class="select inline" name="options" id="options">
            <optgroup class="rtl" label="دسته بندی:">
                  <?=showListCategory();?>
            </optgroup>
        </select>
          <input  class="btnlogin inline hidden" id="btnSaveEditLink" style="width: 100px; height: 30px; background-color: #2E7D32" type="button" value="save" onclick="updateLinkEdit()" >
           <input  class="btnlogin inline" id="btnInsertLink" style="width: 100px; height: 30px; background-color: <?=$config['color_button_submit']?>" type="button" value="<?=$config['button_submit_title']?>" onclick="insertNewLink()" >
          <input  class="btnlogin hidden" id="btnCancelEditLink" style="display: block;width: 100px; height: 30px; background-color: #C62828;display: inline-block;" type="button" value="cancel" onclick="cancelEdit()" >
        </div>
      </div>




  <br class="br">

</div>
<div class="nohigh inline">
  <?php require_once('boxes.php');?>
</div>
</div>
</div>

<script>

window.onload = function () {
$('#spinner-loading').removeClass("cm-spinner");
$('#turn-shadow-bg').removeClass("shadows");
}
    
    $(function(){

    });
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    var ckeditor =    CKEDITOR.replace( 'linkTitle' );
     let desc = CKEDITOR.instances['linkTitle'].getData();



  $('#btnSaveEditLink').hide();
  $('#btnCancelEditLink').hide();

function openForm() {
  document.getElementById("myForm").style.display = "block";
  $('#turn-shadow-bg').addClass('shadows');
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
  $('#turn-shadow-bg').removeClass('shadows');
}



function popup($item){
    $("#zex").html('');
	var $log = $( "#zex" ),
		str = $item,
		html = $.parseHTML( str ),
		nodeNames = [];
	$log.append( html );
	$.each( html, function( i, el ) {
		nodeNames[i] = "<li contenteditable='true'>" + el.nodeName + "</li>";
	});
	//$log.append( "<h3>Node Names:</h3>" );
/*	$( "<ol></ol>" )
		.append( nodeNames.join( "" ) )
		.appendTo( $log );
		*/
		

openForm();

// --------------------


/*
var q = $item+'00000';
var w = $item.toString();

//var t = $item.replace(/(&nbsp;|<([^>]+)>)/ig, '');
var h = $.parseHTML( $item );

$('#xxxx').parseHTML( $item );


  new Attention.Alert({
    title: 'Idea',
    content: t
  });


   $('.content').attr('contenteditable', 'true');
    var z = $('.content').innerHtml;
    var s = z.toString();

    $('.content').html('sdf');
*/


}



  function insertNewLink(){
  var editedText = CKEDITOR.instances['linkTitle'].getData();

    var linkTitle = $('#linkTitle').val();
    // var linkAddress = $('#linkAddress').val();
    var category = $('#options').val();
    console.log(linkTitle);
    // console.log(linkAddress);
    console.log(category);
    var dialogAlert = '<i class="fa fa-check-circle"></i>';
      $.ajax('db.php', {
              type: 'post',
              dataType: 'json',
              data: {
                link_title: editedText,
                // link_address: linkAddress,
                category_opt: category,
                call: 'newlink'
              },
              success: function (data){
                if(data['insertnewlink'] == 'success'){
                  $('.' + category ).prepend('<div class="nohigh ' + data['id']  + '" style="">' +
                    '<span class="inline" style="height: max-content;float: right; width: 80%">' +
                    // '<a id="address' + data['id']  +   '" class="" href="' + data['link']  +'" target="_blank">' +
                    '<span hidden id="' + data['id']  + '"></span>' +
                    '<li onclick="popup(this.innerHTML)"  title="<b>hello world</b> sdfsdf" id="title' + data['id']  +   '" class="limit item-idea pre-wrap li-linkdooni inline lnk' + data['id']  + '">' + editedText +' </li>' +
                    // '</a>' +
                    '</span>' +
                    '<span class="inline" style="float: left; width: 20% ">' +
                    '<li class="li-linkdooni inline operate operator-edit" id="' + data['id']  +   '" style="" onclick="editLink(this.id)"><i class="fa fa-pencil-alt"></i></li>' +
                    '<li class="li-linkdooni inline operate operator-edit" id="' + data['id']  +   '" style="" onclick="deleteLink(this.id)"><i class="fa fa-trash-alt"></i></li>' +
                    '</span>' +
                    '</div>');
                  $('#linkTitle').val('');
                  // $('#linkAddress').val('');
                  console.log('success');
                  console.log(data['id']);
                  alert('ایده جدید ثبت شد');
                }
              }
            });


  }

  function updateLinkEdit(){

    var editedText = CKEDITOR.instances['linkTitle'].getData();
      var linkTitle = $('#linkTitle').val();
      // var linkAddress = $('#linkAddress').val();
      var linkID= $('#hiddenIdLink').val();
      // var titleItem = $('#title' + linkID);
      // var addressItem = $('#address' + linkID);
      console.log('update this:' + editedText);

      $.ajax('db.php', {
              type: 'post',
              dataType: 'json',
              data: {
                link_title: editedText,
                // link_address: linkAddress,
                link_id: linkID,
                call: 'updateLinkEdit'
              },
              success: function (data){
                if(data['updatelink'] == 'success'){
                  console.log('success');
                  $('#title' + linkID).html(editedText);
                  // $('#address' + linkID).html(linkAddress);
                  // $('#address' + linkID).attr("href", linkAddress);

                  $('#btnSaveEditLink').hide();
                  $('#btnCancelEditLink').hide();
                  $('#options').show();
                  $('#btnInsertLink').show();
                  $('#linkTitle').val('');
                  // $('#linkAddress').val('');

                  alert('با موفقیت ویرایش شد');
                   CKEDITOR.instances.linkTitle.setData('');

                }
              }
            });
  }

  function cancelEdit(){
    CKEDITOR.instances.linkTitle.setData('');
    $('#btnSaveEditLink').hide();
    $('#btnCancelEditLink').hide();
    $('#btnInsertLink').show();
    $('#options').show();
    $('#linkTitle').val('');
    $('#linkAddress').val('');

  }

  function editLinkSave(){

    $('#btnInsertLink').hide();
    $('#options').hide();
    $('#btnSaveEditLink').show();
    $('#btnCancelEditLink').show();

  }



  function editLink(id){

     //desc.insertText("");

    
    console.log('CkEdior data:' + CKEDITOR.instances['linkTitle'].getData());
    var link_id  = id;
    var lnkID = 'title' + link_id ;
    var lnkADRESS = 'address' + link_id ;
    var lnkTitle = document.getElementById(lnkID).innerHTML;
    var linkAddress = $('#' +lnkADRESS).attr('href');
    
    ckeditor.insertHtml(lnkTitle);
    //$('#linkTitle').val(lnkTitle);
    //$('#linkTitle').val(lnkTitle);
    $('#linkAddress').val(linkAddress);
    $('#hiddenIdLink').val(link_id);
    // alert($('#hiddenIdLink').val());
    console.log('id text:' + lnkTitle);
    //console.log(linkAddress);
    editLinkSave();


  }

  function deleteLink(id){
    var link_id = id;

    if (confirm('ایده حذف شود؟')) {
      $.ajax('db.php', {
        type: 'post',
        dataType: 'json',
        data: {
          link_id: link_id,
          call: 'deleteLink'
        },
        success: function (data){
          if(data['deletelink'] == 'success'){
            // alert('حذف شد');
            console.log('حذف شد');
            $('.' + link_id).remove();
          }
        }
      });
    } else {

    }


  }
  $(document).keyup(function(e) {
     if (e.key === "Escape") { // escape key maps to keycode `27`
        // <DO YOUR WORK HERE>
            closeForm();
    }
});
</script>

</body>
</html>



