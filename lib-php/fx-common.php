<?php

function ReNewSession($conn, $user_id)
{
  $new_exp = time() + 3600;
  if (SqlUpdate('user', 'user_exp='.$new_exp.'', 'user_id ='.$user_id, $conn)) {
    return TRUE;
  } else {
    return FALSE;
  }
}

?>
