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



$k = $db->DohvatiInterese();
$i=$db->DohvatiInteresePoKorisniku($id);



	header("Content-Type:application/xml");
        header('Access-Control-Allow-Origin: *');
	echo '<?xml version="1.0" encoding="utf-8"?><Interesi>';


	foreach($k as $interes) {
$isto=0;
foreach($i as $interes2){

if($interes["IdInteres"]==$interes2["IdInteres"]){
$isto++;
echo "<Interes Odabran='1' IdInteresa='".$interes["IdInteres"]."' NazivInteresa='".$interes["Naziv"]."' IdKategorije='".$interes["IdKat"]."' NazivKategorije='".$interes["NazivKategorije"]."'></Interes>";


}
}
if($isto==0){
echo "<Interes Odabran='0' IdInteresa='".$interes["IdInteres"]."' NazivInteresa='".$interes["Naziv"]."' IdKategorije='".$interes["IdKat"]."' NazivKategorije='".$interes["NazivKategorije"]."'></Interes>";
}
	
		} 

	
	echo "</Interesi>";
	
	
?>





