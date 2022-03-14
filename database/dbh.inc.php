<?php

$servername = 'LocalHost';
// $dBUsername = 'portAdmin@portfoliation';
// $dBPassword = "port.Admin";
// $dBUsername = 'root';
//  $dBPassword = "";
$dBUsername = 'root';
$dBPassword = "";
//$dBName = "pdb";
$dBName = "pdd";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
