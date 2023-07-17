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
        $regex = "/^[a-zA-Z](?=.*[A-Z])(?=.*\d)(?=.*[$@%&*?!])[A-Za-z\d$@%&*?!]{4,8}$/";
        
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
            if(!$error>0){ echo "<p>Uspesno dodata slika na server!";}  
        }else{
                $path = "C:\wamp64\www\IPprojekat\slike\korisnici\default_user.jpg";
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $default = file_get_contents($path);
                #$_SESSION['defaultImageUser'] = $default;
                $data = '<img src="data:image/jpg;base64,'.base64_encode($default).'" height="60px" width=auto />';
                echo "<p>Uspesno dodata podrazumevana slika na server!";
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
    if((!preg_match($regex, $lozinka)) && (!preg_match($regex, $potvrda)) ){
        $errors['dveLozinke']="Lozinka nije u dobrom formatu!";
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
       
    }
}

?>




<html>
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <div  class="sve">
            <?php include("zaglavlje_index.php"); ?>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <?php 
                include_once('errors.php'); ?>
                <div>
                <table  class="sve nav">
                    <th colspan="2">
                        REGISTRUJTE SE
                    </th>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Korisnicko ime:
                        </td>
                        <td>
                            <input type="text" name="korIme" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lozinka : 
                        </td>
                        <td>
                            <input type="password" name="lozinka" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ponovite lozinku : 
                        </td>
                        <td>
                            <input type="password" name="lozinkaponovo" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ime i prezime :
                        </td>
                        <td>
                            <input type="text" name="imePrezime" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Adresa :
                        </td>
                        <td>
                            <input type="text" name="adresa" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Telefon :
                        </td>
                        <td>
                            <input type="tel" name="telefon" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-mail :
                        </td>
                        <td>
                            <input type="email" name="imejl" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Slika : 
                        </td>
                        <td>
                            <input type="file" name="slika"/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <input class="dugme" type="submit" name="insertpomocna" value="Unesi"/>
                            <input class="dugme" type="reset" value="Poništi"/>
                        </td>
                    </tr>
                </table>
                </form>
            </div>
            <p>
            Već ste član biblioteke? <a href="login.php">Ulogujte se<a/>
            </p>
        
    </body>
</html>




