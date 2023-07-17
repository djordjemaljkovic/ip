<?php
    include('../dbconnection.php');
    
if(isset($_POST['obrisi'])){
    $korisnik = $_POST['korisnik'];
    #echo "$korisnik";
    
    $resultc = mysqli_query($conn, "DELETE FROM citaoci WHERE korIme='$korisnik'");
    $resultm = mysqli_query($conn, "DELETE FROM moderatori WHERE korIme='$korisnik'");
    if($resultc || $resultm) {
        echo "Korisnik je uspesno obrisan!";
            ?> &nbsp; 
            <a href="admin_obrisi.php">Povratak</a> <?php
        }else{
            echo "Greska pri brisanju korisnika!";
        }
        
        #mysqli_free_result($resultc);
        #mysqli_free_result($resultm);
        
        
    }

