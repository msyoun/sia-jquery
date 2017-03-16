<?php

session_start();

include 'config.php';
include 'fx-sql.php';
include 'fx-common.php';

if (isset($_SESSION['ID']) && isset($_SESSION['TOKEN'])) {
  $where = 'user_id = '.$_SESSION['ID'].' && user_token ="'.$_SESSION['TOKEN'].'"';
  if ($result = SqlSelect('*','user',$where,$conn)) {
    $user = Fetch($result);
    if ($user['user_exp'] > time()) {
      if (ReNewSession($conn, $user['user_id']) === TRUE) {
        //$_SESSION['ALERT'] = "VALOR VERDADERO";
        echo 'TRUE';
      } else {
        //$_SESSION['ALERT'] = "VALOR FALSO1";
        echo 'FALSE';
      }
    } else {
      //$_SESSION['ALERT'] = "VALOR FALSO2";
      echo 'FALSE';
    }
  } else {
    //$_SESSION['ALERT'] = "VALOR FALSO4";
    echo 'FALSE';
  }
} else {
  //$_SESSION['ALERT'] = "VALOR FALSO3";
  echo 'FALSE';
}

//$_SESSION['STATUS'] = "SCRIPT EJECUTADO";

?>
