<?php

require('DbPlugin.php');

$db = new Baza();

$db->spremiNoviInteres($_POST['interest'],$_POST['idcategory']);

$parametar=$_POST['username'];
$parametar2=$_POST['interest'];

$mysqli=$db->spojiSe();
  $sql = "SELECT id_korisnik FROM Korisnik WHERE username = '".$parametar."'";
  $sql2= "SELECT id_interes FROM Interesi WHERE naziv_interes = '".$parametar2."'";
if($rs = $mysqli->query($sql)) {
        
        if($rs->num_rows === 1) {
          $kor = $rs->fetch_assoc();

$idKorisnika=$kor['id_korisnik'];
$rs = $mysqli->query($sql2);
  if($rs->num_rows === 1) {
          $int = $rs->fetch_assoc();
$idInteresa=$int['id_interes'];
}



		$db->spremiInterese($idInteresa,$idKorisnika);
			
       
            $mysqli->close();
           
       } 
else {

            echo "0";
$mysqli->close();

}
}
$a=trim($idInteresa);
echo "ID=$a";



?>

