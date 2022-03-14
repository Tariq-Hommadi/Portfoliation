<?php
 require_once 'dbh.inc.php';

  
 echo "<pre> </pre>";



$num = 100;
$n = 1;

 for($num; $num<200; $num++, $n++){



     if(isset($_POST[$num])){
//  echo "deleted clicked <br>". $num . "<br>";
        $sql = "DELETE FROM section WHERE secID=$n ";
         $conn->query($sql);
       

    }

 }



?>