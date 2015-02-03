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
$parametri=0;
$IDinteresa = array();
$Jungosi=array();
$i=0;
foreach ($_POST as $k => $vr)
{
$IDinteresa[$i] = $vr;
$i++;
$parametri++;
}


switch($parametri){
case 1: $SQLupit= " Select distinct t1.id_korisnik from Korisnik_ima_Interes t1
Inner Join Korisnik_ima_Interes t2
on t1.id_korisnik = t2.id_korisnik
Where t1.id_korisnik !=$id
And t2.id_interes = $IDinteresa[0]";
$mysqli=$db->spojiSe();
$rs = $mysqli->query($SQLupit);
  if ($rs) {
                while ($red = $rs->fetch_assoc()) {
                    
                    $Jungosi[] = $red;
                }
            } else {
                echo $mysqli->error . " upit:" .$SQLupit ;
            }
        

 $mysqli->close();
break;
case 2: $SQLupit= " Select distinct t1.id_korisnik from Korisnik_ima_Interes t1
Inner Join Korisnik_ima_Interes t2
on t1.id_korisnik = t2.id_korisnik
Inner Join Korisnik_ima_Interes t3
On t1.id_korisnik = t3.id_korisnik
Where t1.id_korisnik !=$id
And t2.id_interes = $IDinteresa[0]
And t3.id_interes =  $IDinteresa[1]";
$mysqli=$db->spojiSe();
$rs = $mysqli->query($SQLupit);
  if ($rs) {
                while ($red = $rs->fetch_assoc()) {
                    
                    $Jungosi[] = $red;

                }
            } else {
                echo $mysqli->error . " upit:" .$SQLupit ;
            }
        

 $mysqli->close();

break;
case 3: $SQLupit= " Select distinct t1.id_korisnik from Korisnik_ima_Interes t1
Inner Join Korisnik_ima_Interes t2
on t1.id_korisnik = t2.id_korisnik
Inner Join Korisnik_ima_Interes t3
On t1.id_korisnik = t3.id_korisnik
Inner Join Korisnik_ima_Interes t4
On t1.id_korisnik = t4.id_korisnik
Where t1.id_korisnik !=$id
And t2.id_interes = $IDinteresa[0]
And t3.id_interes =  $IDinteresa[1]
And t4.id_interes =  $IDinteresa[2]";
$mysqli=$db->spojiSe();
$rs = $mysqli->query($SQLupit);
  if ($rs) {
                while ($red = $rs->fetch_assoc()) {
                    
                    $Jungosi[] = $red;
                }
            } else {
                echo $mysqli->error . " upit:" .$SQLupit ;
            }
        

 $mysqli->close();

break;



}
header("Content-Type:application/xml");
        header('Access-Control-Allow-Origin: *');
	echo '<?xml version="1.0" encoding="utf-8"?><Korisnici>';

foreach($Jungosi as $korisnik) {
$k = $db->DohvatiKorisnika($korisnik["id_korisnik"]);



	foreach($k as $frend) {
	
echo "<Korisnik IdKorisnika='".
							$frend["IdKorisnik"]."' Ime='".
							$frend["Ime"]."' Prezime='".
							$frend["Prezime"]."' Spol='".$frend["Spol"]."' Adresa='".$frend["Adresa"]."' EMail='".$frend["EMail"]."' BrojMob='".$frend["BrojMob"]."'></Korisnik>";
		} 
	
	
	


}
	echo "</Korisnici>";

?>