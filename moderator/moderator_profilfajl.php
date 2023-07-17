<?php

include('../dbconnection.php');

if(isset($_POST['azurirajpodatkeoprofilu'])){
    $idk = $_POST['idk'];   
}



if(isset($_POST['profil'])){
        $idk = $_POST['idkvalue'];
        $imePrezime = "";
        $adresa = "";
        $telefon = "";
        $imejl = "";
        $slika = "";
        $lozinka ="";
        $stara ="";
        $nova ="";
        $data ="";
        $errors = array();
        $imePrezime = $_POST['imePrezime'];
        $adresa = $_POST['adresa'];
        $telefon = $_POST['telefon'];
        $imejl = $_POST['imejl'];
        $stara = $_POST['staraloz'];
        $stara = md5($stara);
        $nova = $_POST['novaloz'];
    
        define("UPLOADDIR", "../slike/korisnici/");
        if(isset($_FILES['slikaProfil']) && $_FILES['slikaProfil']['size']>0){
            $temp = $_FILES['slikaProfil']['tmp_name'];
            $error = $_FILES['slikaProfil']['error'];
            $file = $_FILES['slikaProfil']['name'];
            $uploadfile = UPLOADDIR . $file;
            $type = pathinfo($uploadfile, PATHINFO_EXTENSION);
            $image = file_get_contents($uploadfile);
            $data = '<img src="data:image/jpg;base64,'.base64_encode($image).'" height="100px" width=auto name="slikadugme"/>';
            if(!$error >0){
            echo "<p>Uspesno poslata slika na server!";
            }
        }else{
                $path = "C:\wamp64\www\IPprojekat\slike\korisnici\default_user.jpg";
                $type = pathinfo($path, PATHINFO_EXTENSION);
                $default = file_get_contents($path);
                $_SESSION['defaultImageBook'] = $default;
                $data = '<img src="data:image/jpg;base64,'.base64_encode($default).'" height="100px" width=auto name="slikadugme"/>';
                $query8 = mysqli_query($conn, "UPDATE citaoci SET slika ='$data' WHERE korIme = '$idk'");
                echo "<p>Uspesno dodata podrazumevana slika na server!";
                
            }
        
    
    
        
    
    if(count($errors) == 0) {
        $query1 =""; $query2 = ""; $query3=""; $query4=""; $query5=""; $query6=""; $query7=""; 
        if(!empty($imePrezime)){
        $query1 = mysqli_query($conn, "UPDATE moderatori SET imePrezime = '$imePrezime' WHERE korIme='$idk'");
        }
        if(!empty($adresa)){
        $query2 = mysqli_query($conn, "UPDATE moderatori SET adresa = '$adresa' WHERE korIme='$idk'");
        }
        if(!empty($telefon)){
        $query3 = mysqli_query($conn, "UPDATE moderatori SET telefon = '$telefon' WHERE korIme='$idk'");
        }
        if(!empty($imejl)){
        $query4 = mysqli_query($conn, "UPDATE moderatori SET imejl = '$imejl' WHERE korIme='$idk'");
        }
        if(isset($_FILES['slikaProfil']) && !empty($_FILES['slikaProfil']) && $data!=""){
        $query5 = mysqli_query($conn, "UPDATE moderatori SET slika = '$data' WHERE korIme='$idk'");
        }
        $query6 = mysqli_query($conn, "SELECT lozinka FROM moderatori WHERE korIme='$idk'");
        $row = mysqli_fetch_assoc($query6);
        if($stara != ""){
        if((!empty($row['lozinka']) && $row['lozinka']== $stara) && !empty($nova)){
        $nova = md5($nova);
        $query7 = mysqli_query($conn, "UPDATE moderatori SET lozinka = '$nova' WHERE korIme='$idk'");
        }}
        #$_SESSION['korIme'] = $korIme;
        #$_SESSION['status'] = "ceka potvrdu";
        if(!empty($query1) || !empty($query2) || !empty($query3) || !empty($query4) || !empty($query5) || !empty($query7)){
           echo "Podaci su uspesno azurirani!";
        }else{
           echo "<span style = 'color:red'>Nije izabran nijedan podatak za azuriranje!</span>";
        }
        ?>
    <a href="moderator_profil.php">Nazad</a>
    <?php
    }
}

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div  class="sve">
        <?php include_once("moderator_meni.php"); ?>
        <h2>Informacije o profilu</h2>
        <hr/>
        
        
        <form action="" method="POST" enctype="multipart/form-data">
                <?php 
                include_once('../errors.php'); ?>
                <div>
                <table  class="sve nav">
                    <th colspan="2">
                        AZURIRAJ SVOJE LICNE PODATKE
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
                            Ime i prezime:
                        </td>
                        <td>
                            <input type="text" name="imePrezime" /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Adresa : 
                        </td>
                        <td>
                            <input type="text" name="adresa"/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Telefon : 
                        </td>
                        <td>
                            <input type="text" name="telefon"/><br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-mail :
                        </td>
                        <td>
                            <input type="text" name="imejl" /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Slika :
                        </td>
                        <td>
                            <input type="file" name="slikaProfil" /> <br/>
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
                            Stara lozinka :
                        </td>
                        <td>
                            <input type="password" name="staraloz" /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nova lozinka :
                        </td>
                        <td>
                            <input type="password" name="novaloz" /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <input type="hidden" name="idkvalue" value ="<?php echo $idk;?>"/>
                        </td>
                        <td>
                            <input class="dugme" type="submit" name="profil" value="Potvrdi izmene"/>
                            <input class="dugme" type="reset" value="Poništi"/>
                        </td>
                    </tr>
                </table>
                </form>

        
        
        </div>
        
    </body>
</html>
