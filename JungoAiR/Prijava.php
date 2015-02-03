<?php

require('DbPlugin.php');



if (isset($_POST['username'])) {

    $db = new Baza();

$mysqli=$db->spojiSe();



  $korisnik = $_POST['username'];
    $lozinka = $_POST['password'];






    $sql = "SELECT id_korisnik FROM Korisnik WHERE username = '$korisnik' AND password = '$lozinka'";
   

    if ($rs = $mysqli->query($sql)) {
        
        if($rs->num_rows === 1) {
           echo "1";

         
       
            $mysqli->close();
           
       } 
else {

            echo "0";
}
} }


?>


          
  


            
     
