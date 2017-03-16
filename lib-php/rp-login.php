<?php

  session_start();

  include 'config.php';
  include 'fx-sql.php';
  include 'fx-common.php';

  // AGREGAR SANITACION DE SQL

  $where = 'user_name ="'.$_POST['username'].'" && user_pass ="'.$_POST['password'].'"';
  if ($result = SqlSelect('*','user',$where, $conn)) {

    $user = Fetch($result);

    $_SESSION['ID'] = $user['user_id'];

    if (ReNewSession($conn, $user['user_id']) === TRUE) {

      $sha_gen = hash('SHA512', time());
      if (SqlUpdate('user','user_token="'.$sha_gen.'"','user_id='.$user['user_id'],$conn)) {
        $_SESSION['TOKEN'] = $sha_gen;
        echo "TRUE";
      } else {
        echo "FALSE";
      }
    } else {
      echo "FALSE";
    }
  } else {
    echo "FALSE";
  }
?>
