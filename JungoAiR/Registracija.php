<?php



function popunjenost(){
$greska=0;
foreach ($_POST as $k => $vr)
{
if($vr=='' && $k!='mobitel') $greska++;
}
if($greska!=0){echo "Nije sve popunjeno";

foreach ($_POST as $k => $vr)
{
if($vr=='') echo "$k";
}

 }


return $greska;
}

function ProvjeraEMaila(){
$greska2=0;
$mail=$_POST['email'];


if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
 echo '';
} else {
$greska2++;
  echo "Email nije ispravan <br>";
}

return $greska2;
}


$p=popunjenost();

$p3=ProvjeraEMaila();

if(!$p){

if(!$p3){require('DbPlugin.php');
		$db = new Baza();


$db->spremiKorisnika($_POST['ime'],$_POST['prezime'],$_POST['spol'],$_POST['adresa'],$_POST['email'],$_POST['username'],$_POST['password'],$_POST['datumRodjenja'],$_POST['mobitel']);

}}









?>
