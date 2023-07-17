<?php

include('dbconnection.php');




if(isset($_POST['insertpomocna'])){
        $korIme = "";
        $lozinka = "";
        $potvrda = "";
        $imePrezime = "";
        $adresa = "";
        $telefon = "";
        $imejl = "";
        $data = "";
        $errors = array();
        $korIme = $_POST['korIme'];
        $lozinka = $_POST['lozinka'];
        $potvrda = $_POST['lozinkaponovo'];
        $imePrezime = $_POST['imePrezime'];
        $adresa = $_POST['adresa'];
        $telefon = $_POST['telefon'];
        $imejl = $_POST['imejl'];
        
//    if(!empty($_FILES["slika"]["name"])){
//    $filename=basename($_FILES["slika"]["name"]);
//    $filetype=pathinfo($filename, PATHINFO_EXTENSION);
//    $allowtypes=array('jpg','png','jpeg','gif');
//    if(in_array($filetype,$allowtypes)){
//        $image = $_FILES['slika']['tmp_name'];
//        $imgContent= addslashes(file_get_contents($image));
//    }
//    $folder = "slike/korisnici".$filename;
//    }
        
        define("UPLOADDIR", "slike/korisnici/");
        if(isset($_FILES['slika']) && $_FILES['slika']['size']>0){
            $temp = $_FILES['slika']['tmp_name'];
            $error = $_FILES['slika']['error'];
            $file = $_FILES['slika']['name'];
            $uploadfile = UPLOADDIR . $file;
            $type = pathinfo($uploadfile, PATHINFO_EXTENSION);
            $image = file_get_contents($uploadfile);
            $data = '<img src="data:image/jpg;base64,'.base64_encode($image).'" height="60px" width=auto />';
            if(!$error>0){
                echo "<p>Uspesno dodata slika na server!";
            }else{
                $path = "C:\wamp64\www\IPprojekat\slike\korisnici\default_user.jpg";
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $default = file_get_contents($path);
                #$_SESSION['defaultImageUser'] = $default;
                $data = '<img src="data:image/jpg;base64,'.base64_encode($default).'" height="60px" width=auto />';
                echo "<p>Uspesno dodata podrazumevana slika na server!";
            }
        }
    
    
    if(empty($korIme)){
        $errors['korIme'] = "Polje za korisnicko ime je prazno!";
    }
     if(empty($lozinka)){
        $errors['lozinka']= "Polje za lozinku je prazno!";
    }
     if(empty($potvrda)){
        $errors['potvrda']= "Polje za potvrdu lozinke je prazno!";
    }
     if(empty($imePrezime)){
        $errors['imePrezime']= "Polje za ime i prezime je prazno!";
    }
     if(empty($adresa)){
        $errors['adresa']= "Polje za adresu je prazno!";
    }
     if(empty($telefon)){
        $errors['telefon']= "Polje za kontakt telefon je prazno!";
    }
     if(empty($imejl)){
        $errors['imejl']= "Polje za e-mail adresu je prazno!";
    }
     if($lozinka != $potvrda){
        $errors['dveLozinke']="Potvrda lozinke nije dobro unesena!";
    }
    
    
    if(count($errors) == 0) {
        $lozinka=md5($lozinka);
        $query1 = "INSERT INTO pomocna (korIme,lozinka,imePrezime,adresa,telefon,imejl,slika) VALUES ('$korIme','$lozinka','$imePrezime','$adresa','$telefon','$imejl','$data')";
        $result1 = mysqli_query($conn, $query1);
        $_SESSION['korIme'] = $korIme;
        $_SESSION['status'] = "ceka potvrdu";
        if($result1){
           echo "Korisnik uspesno dodat!";
        }else{
           echo "<span style = 'color:red'>Greska pri dodavanju!</span>";
        }
       # echo "<script>window.location.href='index.php'</script>";
    }
}

?>