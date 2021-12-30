<?php
require_once ('config.php');
require_once ('core.php');

if(isset($_POST['to_hash'])){
  $key = $_POST['to_hash'];
  $salt = $_POST['salt'];
  $out['hashkamed'] = hashMaker($key, $salt);
  $out['response'] = 'ok';
  echo json_encode($out);
}