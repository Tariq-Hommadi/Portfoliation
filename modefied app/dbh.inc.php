<?php

//$servername = 'LocalHost';
// $dBUsername = 'portAdmin@portfoliation';
// $dBPassword = "port.Admin";
// $dBUsername = 'root';
//  $dBPassword = "";
//$dBUsername = 'root';
//$dBName = "pdb";
//$dBName = "pdd";
$servername = 'bqazp2xebeks8ly5wysn-mysql.services.clever-cloud.com';
$dBUsername = 'uhn2uxdrqpbig4bi';
$dBPassword = "ODh8EifeOe5ADt9mrAUI";
$dBName = "bqazp2xebeks8ly5wysn";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
