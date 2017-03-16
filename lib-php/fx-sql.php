<?php

$conn = mysqli_connect(SQLserver,SQLuser,SQLpass,SQLdata);

function CheckMysql($conn)
{
  if (!$conn) {
    return FALSE;
  } else {
    return TRUE;
  }
}

function SqlSelect($select, $table, $where='', $conn) {

  $sql = "SELECT $select FROM $table";
  if ($where != '') {
    $sql .= ' WHERE '.$where;
  }
  //echo $sql;

  //Solo si logra el query
  if($result = $conn -> query($sql)) {
    if ($result -> num_rows > 0) {
      return $result;
    } else {
      return FALSE;
    }
  } else {
    return FALSE;
  }



}

function SqlInsert($table, $column, $values, $conn) {

  $sql = "INSERT INTO $table ($column) VALUES ($values)";

  if ($conn -> query($sql) === TRUE) {
    return TRUE;
  } else {
    return FALSE;
  }

}

function SqlUpdate($table, $values, $where = '', $conn)
{


  $sql = "UPDATE $table SET $values";

  if ($where != '') {
    $sql .= ' WHERE '. $where;
  }

  if ($conn->query($sql) === TRUE) {
    return TRUE;
  } else {
    return FALSE;
  }

}

function Fetch($result, $value = 0, $n = 0)
{
  $i = 0;
  while ($row = $result -> fetch_assoc()) {
    $rows[$i] = $row;
    $i++;
  }

  if ($n == 0 && $value != '') {
    return $rows[$n][$value];
  } else if ($n == 0 && $value == '') {
    return $rows[0];
  } else {
    return $rows;
  }
}


?>
