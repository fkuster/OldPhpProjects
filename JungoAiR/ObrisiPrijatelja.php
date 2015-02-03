<?php
require('DbPlugin.php');

$db = new Baza();
$parametar=$_GET['Username'];
$mysqli=$db->spojiSe();
  $sql = "SELECT id_korisnik FROM Korisnik WHERE username = '".$parametar."'";

if($rs = $mysqli->query($sql)) {
        
        if($rs->num_rows === 1) {
          $kor = $rs->fetch_assoc();

$id=$kor['id_korisnik'];

         

       
            $mysqli->close();
           
       } 
else {

            echo "0";
 $mysqli->close();

}
}
$parametar2=$_POST['Jungo'];

if(isset($_POST['Jungo'])){
$k=$db->ObrisiPrijatelja($id,$parametar2);

	
	

}




?>