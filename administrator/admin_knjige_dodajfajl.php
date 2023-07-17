<?php

include('../dbconnection.php');


if(isset($_POST['insertknjiga'])){
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
        $tiraz = $_POST['tiraz'];
//    if(!empty($_FILES["slikaKnjiga"]["name"])){
//    $filename=basename($_FILES["slikaKnjiga"]["name"]);
//    $filetype=pathinfo($filename, PATHINFO_EXTENSION);
//    $allowtypes=array('jpg','png','jpeg','gif');
//    if(in_array($filetype,$allowtypes)){
//        $image = $_FILES['slikaKnjiga']['tmp_name'];
//        $imgContent= addslashes(file_get_contents($image));
//    }
//    $folder = "../slike/knjige".$filename;
//    }
//    
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
    if($brojzanrova >3){
        $errors['brojzanrova'] = "Izabrali ste vise od 3 zanra!";
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
     if(empty($tiraz)){
        $errors['tiraz']= "Polje za tiraz je prazno!";
    }
//    if(empty($_FILES['slikaKnjiga']['name'])){
//        $_FILES['slikaKnjiga']['name']="../slike/knjige/default_book.jpg";
//        $filename=basename($_FILES["slikaKnjiga"]["name"]);
//        $filetype=pathinfo($filename, PATHINFO_EXTENSION);
//        $allowtypes=array('jpg','png','jpeg','gif');
//        if(in_array($filetype,$allowtypes)){
//        $image = $_FILES['slikaKnjiga']['tmp_name'];
//        $imgContent= addslashes(file_get_contents($image));
//        }
//        $folder = "../slike/knjige".$filename;
//    }
    
    
    if(count($errors) == 0) {
        $query1 = "INSERT INTO knjige (naziv,autor,izdavac,godinaIzdavanja,jezik,slika,tiraz) VALUES ('$naziv','$autor','$izdavac','$godinaIzdavanja','$jezik','$file','$tiraz')";
        $result1 = mysqli_query($conn, $query1);
        $upit = mysqli_query($conn, "UPDATE knjige SET zanr = '$zanrovi' WHERE naziv = '$naziv'");
        #$_SESSION['korIme'] = $korIme;
        #$_SESSION['status'] = "ceka potvrdu";
        if($result1 && $upit){
           echo "Knjiga uspesno dodata!";
        }else{
           echo "<span style = 'color:red'>Greska pri dodavanju!</span>";
           echo $file;
        }
        #if (move_uploaded_file($file, $uploadfile)) {
        #echo "<h3>  Image uploaded successfully!</h3>";
        #} else {
        #    echo "<h3>  Default picture uploaded!</h3>";
        #}
        #echo "<script>window.location.href='admin_knjige_dodaj.php'</script>";
    }
}

?>