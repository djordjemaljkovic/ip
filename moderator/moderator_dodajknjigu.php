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
        }
    }
}

?>

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
                        DODAJ KNJIGU
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
                            <input type="text" name="naziv" required /> <br/>
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
                            <select name="zanr[]" id="zanr" multiple>
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
                            <input type="text" name="izdavac" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Godina izdavanja :
                        </td>
                        <td>
                            <input type="text" name="godinaIzdavanja" required /> <br/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Jezik :
                        </td>
                        <td>
                            <input type="text" name="jezik" required /> <br/>
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
                            <input class="dugme" type="submit" name="insertknjiga" value="Unesi"/>
                            <input class="dugme" type="reset" value="Poništi"/>
                        </td>
                    </tr>
                </table>
                </form>

        
        
        </div>
        
    </body>
</html>


