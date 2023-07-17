<?php

include('../dbconnection.php');


if(isset($_POST['obrisiknjiga'])){
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
    $idk = $_POST['idk'];
    $knjiga = $_POST['idk'];
    #echo "$korisnik";
    
    $result = mysqli_query($conn, "DELETE FROM knjige WHERE idKnjige='$knjiga'");
    if($result) {
        echo "Knjiga je uspesno obrisana!";
            ?> &nbsp; 
            <a href="admin_knjige_obrisi.php">Povratak</a> <?php
        }else{
            echo "Greska pri brisanju knjige!";
        }
        
        #mysqli_free_result($resultc);
        #mysqli_free_result($resultm);
        
        
    }



?>