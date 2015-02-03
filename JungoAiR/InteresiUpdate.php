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


         $sql = "Delete from Korisnik_ima_Interes  WHERE id_korisnik=$id";
		$mysqli->query($sql);
		foreach ($_POST as $k => $vr){
		$db->spremiInterese($vr,$id);
			}
       
            $mysqli->close();
           
       } 
else {

            echo "0";
$mysqli->close();

}
}




?>



