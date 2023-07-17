<?php

include('../dbconnection.php');


if(isset($_POST['insertzahtev'])){
        $naziv = "";
        $autor = "";
        $zanr = "";
        $izdavac = "";
        $godinaIzdavanja = "";
        $jezik = "";
        $slikaKnjiga = "";
        $tiraz = "";
        $zanrovi ="";
        $errors = array();
        $naziv = $_POST['naziv'];
        $autor = $_POST['autor'];
        $zanr = $_POST['zanr'];
        $brojzanrova = sizeof($zanr);
        foreach ($zanr as $elem){
            $zanrovi.=$elem. " ";
        }
        $izdavac = $_POST['izdavac'];
        $godinaIzdavanja = $_POST['godinaIzdavanja'];
        $jezik = $_POST['jezik'];

        
    define("UPLOADDIR", "../slike/knjige/");
        if(isset($_FILES['slikaKnjiga']) && $_FILES['slikaKnjiga']['size']>0){
            
            $temp = $_FILES['slikaKnjiga']['tmp_name'];
            $error = $_FILES['slikaKnjiga']['error'];
            $file = $_FILES['slikaKnjiga']['name'];
            $uploadfile = UPLOADDIR . $file;
            $type = pathinfo($uploadfile, PATHINFO_EXTENSION);
            $image = file_get_contents($uploadfile);
            $data = '<img src="data:image/jpg;base64,'.base64_encode($image).'" height="100%" width=auto />';
            if(!$error>0){ echo "<p>Uspesno dodata slika na server!";}  
        }else{
                $path = "C:\wamp64\www\IPprojekat\slike\knjige\default_book.jpg";
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $default = file_get_contents($path);
                #$_SESSION['defaultImageUser'] = $default;
                $data = '<img src="data:image/jpg;base64,'.base64_encode($default).'" height="100%" width=auto />';
                echo "<p>Uspesno dodata podrazumevana slika na server!";
            }
    
    
    if(empty($naziv)){
        $errors['naziv'] = "Polje za naziv knjige je prazno!";
    }
     if(empty($autor)){
        $errors['autor']= "Polje za autora knjige je prazno!";
    }
     if(empty($zanr)){
        $errors['zanr']= "Polje za zanr knjige je prazno!";
    }
     if(empty($izdavac)){
        $errors['izdavac']= "Polje za izdavaca knjige je prazno!";
    }
     if(empty($godinaIzdavanja)){
        $errors['godinaIzdavanja']= "Polje za godinu izdavanja knjige je prazno!";
    }
     if(empty($jezik)){
        $errors['jezik']= "Polje za jezik na kome je pisana knjiga je prazno!";
    }
    if($brojzanrova >3){
        $errors['brojzanrova'] = "Izabrali ste vise od 3 zanra!";
    }

    
    
    if(count($errors) == 0) {
        $query1 = "INSERT INTO zahtevi (naziv,autor,izdavac,godinaIzdavanja,jezik,slika) VALUES ('$naziv','$autor','$izdavac','$godinaIzdavanja','$jezik','$file')";
        $result1 = mysqli_query($conn, $query1);
        $upit = mysqli_query($conn, "UPDATE zahtevi SET zanr = '$zanrovi' WHERE naziv = '$naziv'");
        if($result1 && $upit){
           echo "<span style='color:green'>Zahtev za knjigu uspesno prosledjen moderatoru!</span>";
        }else{
           echo "<span style = 'color:red'>Greska pri slanju zahteva!</span>";
        }
        ?>
<br/>
<a href="citalac_zahtev.php">Nazad</a>
        <?php
    }
}

?>