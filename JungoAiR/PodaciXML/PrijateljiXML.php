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


$k = $db->DohvatiPrijatelje($id);


	header("Content-Type:application/xml");
        header('Access-Control-Allow-Origin: *');
	echo '<?xml version="1.0" encoding="utf-8"?><OniKojeZnamINeznam>';


	foreach($k as $frend) {
	
echo "<Frend IdKorisnika='".$frend["IdKorisnik"]."' Ime='".$frend["Ime"]."' Prezime='".$frend["Prezime"]."' Spol='".$frend["Spol"]."' Adresa='".$frend["Adresa"]."' EMail='".$frend["EMail"]."' BrojMob='".$frend["BrojMob"]."' IdOdnosa='".$frend["IdOdnosa"]."' NazivOdnosa='".$frend["NazivOdnosa"]."' Lokacija='".$frend["Lokacija"]."'></Frend>";
		} 


$k = $db->DohvatiAnonimuse($id);
foreach($k as $frend) { if($frend["IdKorisnik"]!=$id) echo "<Anonimus IdKorisnika='".$frend["IdKorisnik"]."' Ime='".$frend["Ime"]."' Prezime='".$frend["Prezime"]."' Spol='".$frend["Spol"]."' Adresa='".$frend["Adresa"]."' EMail='".$frend["EMail"]."' BrojMob='".$frend["BrojMob"]."' Lokacija='".$frend["Lokacija"]."'></Anonimus>";

} 



	echo "</OniKojeZnamINeznam>";
	
	
?>

