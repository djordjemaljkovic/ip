<?php
    include('../dbconnection.php');

if(isset($_POST['citalac'])){
    $korisnik = $_POST['korisnik'];
    #echo "$korisnik";
    
    $result = mysqli_query($conn, "SELECT * FROM pomocna WHERE korIme ='$korisnik'");
    if(!$result){
        echo "Greska pri pronalazenju korisnika!";
    }
    
    while($row = mysqli_fetch_assoc($result)){
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
        $result1 = mysqli_query($conn, "INSERT INTO citaoci (korIme,lozinka,imePrezime,adresa,telefon,imejl,slika) SELECT korIme,lozinka,imePrezime,adresa,telefon,imejl,slika FROM pomocna WHERE korIme = '$korIme'");

        if($result1){
            echo "Korisnik je uspesno postao citalac!";
            $result2 = mysqli_query($conn, "DELETE FROM pomocna WHERE korIme='$korIme'");
            ?> &nbsp; 
            <a href="admin_dodaj.php">Povratak</a> <?php
        }else{
            echo "Greska pri dodavanju korisnika!";
        }
        
        #mysqli_free_result($result);
        #mysqli_free_result($result1);
        #mysqli_free_result($result2);
        
        
    }
}

if(isset($_POST['moderator'])){
    $korisnik = $_POST['korisnik'];
    #echo "$korisnik";
    
    $result = mysqli_query($conn, "SELECT * FROM pomocna WHERE korIme ='$korisnik'");
    if(!$result){
        echo "Greska pri pronalazenju korisnika!";
    }
    
    while($row = mysqli_fetch_assoc($result)){
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
        $result1 = mysqli_query($conn, "INSERT INTO moderatori (korIme,lozinka,imePrezime,adresa,telefon,imejl,slika) SELECT korIme,lozinka,imePrezime,adresa,telefon,imejl,slika FROM pomocna WHERE korIme = '$korIme'");

        if($result1){
            echo "Korisnik je uspesno postao moderator!";
            $result2 = mysqli_query($conn, "DELETE FROM pomocna WHERE korIme='$korIme'");
            ?> &nbsp; 
            <a href="admin_dodaj.php">Povratak</a> <?php
        }else{
            echo "Greska pri dodavanju korisnika!";
        }
        
        
        #mysqli_free_result($result);
        #mysqli_free_result($result1);
        #mysqli_free_result($result2);
        
        
    }
}

if(isset($_POST['ukloni'])){
    $korisnik = $_POST['korisnik'];
    #echo "$korisnik";
    
    $result3 = mysqli_query($conn, "DELETE FROM pomocna WHERE korIme='$korisnik'");
    if($result3) {
        echo "Korisnik je uspesno obrisan!";
            ?> &nbsp; 
            <a href="admin_dodaj.php">Povratak</a> <?php
        }else{
            echo "Greska pri dodavanju korisnika!";
        }
        
        #mysqli_free_result($result3);
        #mysqli_free_result($result);
        #mysqli_free_result($result1);
        #mysqli_free_result($result2);
        
        
    }

