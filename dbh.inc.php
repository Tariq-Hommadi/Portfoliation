<?php

//$servername = 'LocalHost';
// $dBUsername = 'portAdmin@portfoliation';
// $dBPassword = "port.Admin";
// $dBUsername = 'root';
//  $dBPassword = "";
//$dBUsername = 'root';
//$dBName = "pdb";
//$dBName = "pdd";
$servername = 'bgjktakh2v3f1kpk8klm-mysql.services.clever-cloud.com';                #'bqazp2xebeks8ly5wysn-mysql.services.clever-cloud.com';
$dBUsername = 'uhn2uxdrqpbig4bi';              #'uhn2uxdrqpbig4bi';
$dBPassword = "ODh8EifeOe5ADt9mrAUI";
$dBName = "bgjktakh2v3f1kpk8klm";


$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
    die("Error: " . mysqli_connect_error());
}
