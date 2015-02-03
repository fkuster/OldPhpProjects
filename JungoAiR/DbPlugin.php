<?php


class Baza {
    public $_host = "localhost";
    public $_user = ":D";
    public $_database = "WebDiP2012_035";
    public $_pass = ":D";


/**
 * @
 * @return \mysqli
 */
function spojiSe(){
    $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
    $conn->set_charset("utf8");
    return $conn;

    if(! $conn) {
        echo "Problem kod povezivanja na bazu podataka1!";
        exit;
    }
}


/**
 * 
 * @param str $ime 
 * @param type $prezime
 * @param type $spol
 * @param type $adresa
 * @param type $EMail
 * @param type $username
 * @param type $password
 * @param type $datum
 * @param type $mobitel
 */
function spremiKorisnika($ime,$prezime,$spol,$adresa,$EMail,$username,$password,$datum,$mobitel){


    $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
    if(! $conn) {
        echo "Problem kod povezivanja na bazu podataka2! <br>";
        exit;
    }
    $conn->set_charset("utf8");

    $sql = "insert into Korisnik values (default,'".$ime."','".$prezime."','".$spol."','".$adresa."','".$username."','".$password."','".$datum."','".$mobitel."','".$EMail."',default)";
    $rs = $conn->query($sql); 
    if(! $rs) {
        echo "Problem kod upisa u bazu podataka3!<br>";
        echo mysqli_error($conn);
        exit;
    }
    else echo "1";  

    $conn->close();

    
    


}

/**
 * 
 * @return type
 * 
 */
function DohvatiInterese() {
    $zapisi = array();
    $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
    if ($conn->connect_error) {
        echo $conn->connect_error;
    } else {

        $conn->set_charset("utf8");
            //set names utf8

        $sql = "SELECT Interesi.id_interes as IdInteres,Interesi.naziv_interes as Naziv, Interesi.id_kategorije as IdKat,KategorijaInteresa.naziv_kat as NazivKategorije from Interesi,KategorijaInteresa where Interesi.id_kategorije= KategorijaInteresa.id_kategorije";
        $rs = $conn->query($sql);
        if ($rs) {
            while ($red = $rs->fetch_assoc()) {

                $zapisi[] = $red;
            }
        } else {
            echo $conn->error . " upit:" . $sql;
        }
    }
    return $zapisi;
    $conn->close();
}
    /**
     * 
     * @param string $User Vraca username korisnika
     * 
     * @return array Vraca sve usere
     */
    function DohvatiInteresePoKorisniku($User) {
        $zapisi = array();
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {

            $conn->set_charset("utf8");
            //set names utf8

            $sql = "SELECT Interesi.id_interes as IdInteres from Interesi left join Korisnik_ima_Interes on Korisnik_ima_Interes.id_interes=Interesi.id_interes left join Korisnik on Korisnik.id_korisnik=Korisnik_ima_Interes.id_korisnik where Korisnik.id_korisnik=$User";
            $rs = $conn->query($sql);
            if ($rs) {
                while ($red = $rs->fetch_assoc()) {

                    $zapisi[] = $red;
                }
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return $zapisi;
        $conn->close();
    }


    function DohvatiPrijatelje($User) {

        $zapisi = array();
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {

            $conn->set_charset("utf8");
            //set names utf8

            $sql = "SELECT Korisnik.id_korisnik as IdKorisnik,Korisnik.zadnje_poznata_lokacija as Lokacija,Korisnik.ime_korisnik as Ime, Korisnik.prezime_korisnik as Prezime,Korisnik.spol_korisnik as Spol,Korisnik.adresa_korisnik as Adresa,Korisnik.EMail as EMail,Korisnik.broj_mobitela as BrojMob,Odnos.id_odnos as IdOdnosa,Odnos.naziv_odnos as NazivOdnosa from Korisnik,OdnosKorisnika,Odnos where ((OdnosKorisnika.id_korisnik=$User and Korisnik.id_korisnik=OdnosKorisnika.id_korisnik1) OR (OdnosKorisnika.id_korisnik1=$User and Korisnik.id_korisnik=OdnosKorisnika.id_korisnik )) and OdnosKorisnika.id_odnos=Odnos.id_odnos";
            $rs = $conn->query($sql);
            if ($rs) {
                while ($red = $rs->fetch_assoc()) {

                    $zapisi[] = $red;
                }
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return $zapisi;
        $conn->close();
    }

    function spremiInterese($IdInteresa,$IdKorisnika){

        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if(! $conn) {
            echo "Problem kod povezivanja na bazu podataka5! <br>";
            exit;
        }
        $conn->set_charset("utf8");

        $sql = "insert into Korisnik_ima_Interes values ($IdKorisnika,$IdInteresa)";
        $rs = $conn->query($sql); 
        if(! $rs) {
            echo "Problem kod upisa u bazu podataka!<br>";
            echo mysqli_error($conn);
            exit;
        }
        else echo "1";  

        $conn->close();





    }

    function spremiNoviInteres($ime,$kategorija){

        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if(! $conn) {
            echo "Problem kod povezivanja na bazu podataka6! <br>";
            exit;
        }
        $conn->set_charset("utf8");

        $sql = "insert into Interesi values (default,'".$ime."',$kategorija)";
        $rs = $conn->query($sql); 
        if(! $rs) {
            echo "Problem kod upisa u bazu podataka7!<br>";
            echo mysqli_error($conn);
            exit;
        }
        else echo "1";  

        $conn->close();





    }
    function DohvatiKorisnika($ID) {
        $zapisi = array();
        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if ($conn->connect_error) {
            echo $conn->connect_error;
        } else {

            $conn->set_charset("utf8");
            //set names utf8

            $sql = "SELECT Korisnik.id_korisnik as IdKorisnik,Korisnik.ime_korisnik as Ime, Korisnik.prezime_korisnik as Prezime,Korisnik.spol_korisnik as Spol,Korisnik.adresa_korisnik as Adresa,Korisnik.EMail as EMail,Korisnik.broj_mobitela as BrojMob from Korisnik where Korisnik.id_korisnik=$ID";
            $rs = $conn->query($sql);
            if ($rs) {
                while ($red = $rs->fetch_assoc()) {

                    $zapisi[] = $red;
                }
            } else {
                echo $conn->error . " upit:" . $sql;
            }
        }
        return $zapisi;
        $conn->close();
    }

    function DodajPrijatelja($Korisnik1,$Korisnik2){

        $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
        if(! $conn) {
            echo "Problem kod povezivanja na bazu podataka6! <br>";
            exit;
        }
        $conn->set_charset("utf8");
        $Odnos=3;
        $sql = "insert into OdnosKorisnika values ($Korisnik1,$Korisnik2,$Odnos)";
        $rs = $conn->query($sql); 
        if(! $rs) {
            $poruka="You are already friends!!";
            return $poruka;
            exit;
        }
        else{ $poruka="Friend added!";  
        return $poruka;
    }
    $conn->close();

    
    


}

function DodajLokaciju($id,$long,$lat){

    $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
    if(! $conn) {
        echo "Problem kod povezivanja na bazu podataka6! <br>";
        exit;
    }
    $conn->set_charset("utf8");

    $sql = "update Korisnik set zadnje_poznata_lokacija='".$long."#".$lat."' where id_korisnik=$id";
    $rs = $conn->query($sql); 
    if(! $rs) {
        echo "Problem kod upisa u bazu podataka7!<br>";

        exit;
    }
    else echo "1";  

    $conn->close();

    
    


}
function ObrisiPrijatelja($id,$jungo){

    $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
    if(! $conn) {
        echo "Problem kod povezivanja na bazu podataka6! <br>";
        exit;
    }
    $conn->set_charset("utf8");

    $sql = "delete from OdnosKorisnika where ((id_korisnik=$id and id_korisnik1=$jungo) or (id_korisnik=$jungo and id_korisnik1=$id))";
    $rs = $conn->query($sql); 
    if(! $rs) {
        echo "Problem kod upisa u bazu podataka7!<br>";

        exit;
    }
    else echo "1";  

    $conn->close();





}

function DohvatiAnonimuse($User) {
    $zapisi = array();
    $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
    if ($conn->connect_error) {
        echo $conn->connect_error;
    } else {

        $conn->set_charset("utf8");
            //set names utf8

        $sql = " select Korisnik.id_korisnik as IdKorisnik,Korisnik.ime_korisnik as Ime, Korisnik.prezime_korisnik as Prezime,Korisnik.spol_korisnik as Spol,Korisnik.adresa_korisnik as Adresa,Korisnik.EMail as EMail,Korisnik.broj_mobitela as BrojMob,Korisnik.zadnje_poznata_lokacija as Lokacija from Korisnik where Korisnik.id_korisnik not in (select Korisnik.id_korisnik from Korisnik,OdnosKorisnika where ((OdnosKorisnika.id_korisnik=$User and Korisnik.id_korisnik=OdnosKorisnika.id_korisnik1) OR (OdnosKorisnika.id_korisnik1=$User and Korisnik.id_korisnik=OdnosKorisnika.id_korisnik )))";
        $rs = $conn->query($sql);
        if ($rs) {
            while ($red = $rs->fetch_assoc()) {

                $zapisi[] = $red;
            }
        } else {
            echo $conn->error . " upit:" . $sql;
        }
    }
    return $zapisi;
    $conn->close();
}


function DohvatiProfil($ID) {
    $zapisi = array();
    $conn = new mysqli($this->_host, $this->_user, $this->_pass, $this->_database);
    if ($conn->connect_error) {
        echo $conn->connect_error;
    } else {

        $conn->set_charset("utf8");
            //set names utf8

        $sql = "SELECT Korisnik.id_korisnik as IdKorisnik,Korisnik.ime_korisnik as Ime,Korisnik.datum_rodjenja as Datum, Korisnik.prezime_korisnik as Prezime,Korisnik.spol_korisnik as Spol,Korisnik.adresa_korisnik as Adresa,Korisnik.EMail as EMail,Korisnik.broj_mobitela as BrojMob,Interesi.naziv_interes as Interes,Korisnik.zadnje_poznata_lokacija as Lokacija from Korisnik,Korisnik_ima_Interes,Interesi where Interesi.id_interes=Korisnik_ima_Interes.id_interes and Korisnik_ima_Interes.id_korisnik=Korisnik.id_korisnik and Korisnik_ima_Interes.id_korisnik=$ID";
        $rs = $conn->query($sql);
        if ($rs) {
            while ($red = $rs->fetch_assoc()) {

                $zapisi[] = $red;
            }
        } else {
            echo $conn->error . " upit:" . $sql;
        }
    }
    return $zapisi;
    $conn->close();
}
}
?>