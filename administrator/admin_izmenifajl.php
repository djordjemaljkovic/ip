<?php
    include('../dbconnection.php');

if(isset($_POST['izmeni'])){
    $korisnik = $_POST['korisnik'];
    #echo "$korisnik";
    
    $resultc = mysqli_query($conn, "SELECT * FROM citaoci WHERE korIme ='$korisnik'");
    $resultm = mysqli_query($conn, "SELECT * FROM moderatori WHERE korIme ='$korisnik'");
    if(!$resultc && !$resultm){
        echo "Greska pri pronalazenju korisnika!";
    }
    
    while($row = mysqli_fetch_assoc($resultc)){
        $korIme = $row['korIme'];
        $lozinka = $row['lozinka'];
        $imePrezime = $row['imePrezime'];
        $adresa = $row['adresa'];
        $telefon = $row['telefon'];
        $imejl = $row['imejl'];
        $slika = $row['slika'];
        $citalac = "citalac";
        #$slikaquery = mysqli_query($conn,"SELECT slika FROM pomocna WHERE korIme = '$korisnik'");
        #$rowslika = mysqli_fetch_assoc($slikaquery);
        #$slikaContent = addslashes(file_get_contents($rowslika['slikaquery']));
        #echo "$slikaContent";
        $resultc1 = mysqli_query($conn, "INSERT INTO moderatori (korIme,lozinka,imePrezime,adresa,telefon,imejl,slika) SELECT korIme,lozinka,imePrezime,adresa,telefon,imejl,slika FROM citaoci WHERE korIme = '$korIme'");

        if($resultc1){
            echo "Korisnik je uspesno postao moderator!";
            $resultc2 = mysqli_query($conn, "DELETE FROM citaoci WHERE korIme='$korIme'");
            ?> &nbsp; 
            <a href="admin_izmeni.php">Povratak</a> <?php
        }else{
            echo "Greska pri promeni privilegije korisnika!";
        }
        
    }
    
    while($row = mysqli_fetch_assoc($resultm)){
        $korIme = $row['korIme'];
        $lozinka = $row['lozinka'];
        $imePrezime = $row['imePrezime'];
        $adresa = $row['adresa'];
        $telefon = $row['telefon'];
        $imejl = $row['imejl'];
        $slika = $row['slika'];
        $citalac = "citalac";
        #$slikaquery = mysqli_query($conn,"SELECT slika FROM pomocna WHERE korIme = '$korisnik'");
        #$rowslika = mysqli_fetch_assoc($slikaquery);
        #$slikaContent = addslashes(file_get_contents($rowslika['slikaquery']));
        #echo "$slikaContent";
        $resultm1 = mysqli_query($conn, "INSERT INTO citaoci (korIme,lozinka,imePrezime,adresa,telefon,imejl,slika) SELECT korIme,lozinka,imePrezime,adresa,telefon,imejl,slika FROM moderatori WHERE korIme = '$korIme'");

        if($resultm1){
            echo "Korisnik je uspesno postao citalac!";
            $resultm2 = mysqli_query($conn, "DELETE FROM moderatori WHERE korIme='$korIme'");
            ?> &nbsp; 
            <a href="admin_izmeni.php">Povratak</a> <?php
        }else{
            echo "Greska pri promeni privilegije korisnika!";
        } 
    }
}



