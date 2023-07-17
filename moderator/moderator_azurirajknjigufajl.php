<?php

include('../dbconnection.php');

if(isset($_POST['azuriraj'])){
    $idk = $_POST['idk'];
}


if(isset($_POST['azurknjiga'])){
        $idk = $_POST['idkvalue'];
        $naziv = "";
        $autor = "";
        $zanr = "";
        $izdavac = "";
        $godinaIzdavanja = "";
        $jezik = "";
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
    
        define("UPLOADDIR", "../slike/knjige/");
        if(isset($_FILES['slikaKnjiga']) && $_FILES['slikaKnjiga']['size']>0){
            $temp = $_FILES['slikaKnjiga']['tmp_name'];
            $error = $_FILES['slikaKnjiga']['error'];
            $file = $_FILES['slikaKnjiga']['name'];
            $uploadfile = UPLOADDIR . $file;
            $type = pathinfo($uploadfile, PATHINFO_EXTENSION);
            $image = file_get_contents($uploadfile);
            $data = '<img src="data:image/jpg;base64,'.base64_encode($image).'" height="100%" width=auto />';
            #if(!$error>0){ echo "<p>Uspesno dodata slika na server!";}  
        }else{
                $path = "C:\wamp64\www\IPprojekat\slike\knjige\default_book.jpg";
                $file ="default_book.jpg";
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
    
    
    if(count($errors) == 0) {
        $query1 = "UPDATE knjige SET naziv = '$naziv', autor = '$autor', izdavac ='$izdavac', godinaIzdavanja='$godinaIzdavanja', jezik='$jezik', slika='$file', tiraz='$tiraz' WHERE idKnjige='$idk'";
        $result1 = mysqli_query($conn, $query1);
        $upit = mysqli_query($conn, "UPDATE knjige SET zanr = '$zanrovi' WHERE naziv = '$naziv'");
        #$_SESSION['korIme'] = $korIme;
        #$_SESSION['status'] = "ceka potvrdu";
        if($result1 && $upit){
           echo "<span style = 'color:green'>Knjiga uspesno azurirana!</span>";
        }else{
           echo "<span style = 'color:red'>Greska pri azuriranju!</span>";
        }
        #header('location: admin_knjige_azur.php');
        #echo "<script>window.location.href='admin_knjige_dodaj.php'</script>";
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
        <?php include("moderator_meni.php"); ?>
        <h2>Dodaj knjigu u biblioteku</h2>
        <hr/>
        
        
        <form action="" method="POST" enctype="multipart/form-data">
                <?php 
                include_once('../errors.php'); ?>
                <div>
                <table  class="sve nav">
                    <th colspan="2">
                        AZURIRAJ PODATKE O KNJIZI
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
                            Naziv knjige:
                        </td>
                        <td>
                            <input type="text" name="naziv" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Autor : 
                        </td>
                        <td>
                            <input type="text" name="autor" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Zanr : 
                        </td>
                        <td>
                            <select name="zanr[]" id="zanr" multiple required>
                                <option value="naucni">Naučni</option>
                                <option value="fiktivni">Fiktivni</option>
                                <option value="akcioni">Akcioni</option>
                                <option value="psiholoski">Psihološki</option>
                                <option value="triler">Triler</option>
                                <option value="komedija">Komedija</option>
                                <option value="romantika">Romantika</option>
                            </select> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Izdavac :
                        </td>
                        <td>
                            <input type="text" name="izdavac" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Godina izdavanja :
                        </td>
                        <td>
                            <input type="text" name="godinaIzdavanja" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Jezik :
                        </td>
                        <td>
                            <input type="text" name="jezik" required/> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Slika :
                        </td>
                        <td>
                            <input type="file" name="slikaKnjiga" /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Tiraz : 
                        </td>
                        <td>
                            <input type="text" name="tiraz" required/> <br/>
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
                            <input type="hidden" name="idkvalue" value ="<?php echo $idk;?>"/>
                        </td>
                        <td>
                            <input class="dugme" type="submit" name="azurknjiga" value="Unesi"/>
                            <input class="dugme" type="reset" value="Poništi"/>
                        </td>
                    </tr>
                </table>
                </form>

        
        
        </div>
        
    </body>
</html>


