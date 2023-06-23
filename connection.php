<?php

    $serverName = "DESKTOP-IGLIOJ0";
    $database = "ElibraryDB";
    
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(!$conn)
    die(print_r(sqlsrv_errors(), true));
//else
  //  echo 'connection established';

$tsql = "select * from User_tbl";

$stmt = sqlsrv_query($conn, $tsql);

if($stmt == false)
{
    echo "error";
}

while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    echo $obj['Name']." ";
     echo $obj['Email'].'<br/>';
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>