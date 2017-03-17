<?php

  session_start();

  include 'config.php';
  include 'fx-sql.php';
  include 'fx-common.php';

  // AGREGAR SANITACION DE SQL
  $sha_pass = hash('SHA512', $_POST['password']);

  $where = 'user_name ="'.$_POST['username'].'" && user_pass ="'.$sha_pass.'"';
  if ($result = SqlSelect('*','user',$where, $conn)) {

    $user = Fetch($result);

    $_SESSION['ID'] = $user['user_id'];

    if (ReNewSession($conn, $user['user_id']) === TRUE) {

      $sha_token = hash('SHA512', time());
      if (SqlUpdate('user','user_token="'.$sha_token.'"','user_id='.$user['user_id'],$conn)) {
        $_SESSION['TOKEN'] = $sha_token;
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
