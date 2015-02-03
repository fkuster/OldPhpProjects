<?php
require('../DbPlugin.php');

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


$k = $db->DohvatiProfil($id);


	header("Content-Type:application/xml");
        header('Access-Control-Allow-Origin: *');
	echo '<?xml version="1.0" encoding="utf-8"?><Profil>';

	
	foreach($k as $frend){
echo "<Frend IdKorisnika='".$frend["IdKorisnik"]."' Ime='".$frend["Ime"]."' Prezime='".$frend["Prezime"]."' Spol='".$frend["Spol"]."' Adresa='".$frend["Adresa"]."' EMail='".$frend["EMail"]."' BrojMob='".$frend["BrojMob"]."' Lokacija='".$frend["Lokacija"]."' Datum='".$frend["Datum"]."'></Frend>";
break;	
}
foreach($k as $frend){
echo "<Interesi>Interes='".$frend["Interes"]."' </Interesi>";

}

 



	echo "</Profil>";
	
	
?>

