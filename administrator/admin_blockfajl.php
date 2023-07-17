<?php
    include('../dbconnection.php');

if(isset($_POST['blokiraj'])){
    $korisnik = $_POST['korisnik'];
    #echo "$korisnik";
    $blokiran = "DA";
    $odblokiran = "NE";
    $resultc1 = mysqli_query($conn, "SELECT blokiran FROM citaoci WHERE korIme ='$korisnik'");
    $rowc = mysqli_fetch_assoc($resultc1);
    if(isset($rowc['blokiran']) && $rowc['blokiran'] == "NE") { 
        $resultc2 = mysqli_query($conn, "UPDATE citaoci SET blokiran = '$blokiran' WHERE korIme='$korisnik'");
        echo "Korisnik je uspesno blokiran";
        ?> &nbsp; 
            <a href="admin_block.php">Povratak</a> <?php
    }elseif(isset($rowc['blokiran']) && $rowc['blokiran'] == "DA"){
        $resultc3 = mysqli_query($conn, "UPDATE citaoci SET blokiran = '$odblokiran'  WHERE korIme='$korisnik'");
        echo "Korisnik je uspesno odblokiran";
        ?> &nbsp; 
            <a href="admin_block.php">Povratak</a> <?php
    }
    $resultm1 = mysqli_query($conn, "SELECT blokiran FROM moderatori WHERE korIme ='$korisnik'");
    $rowm = mysqli_fetch_assoc($resultm1);
    if(isset($rowm['blokiran']) && $rowm['blokiran'] == "NE") { 
        $resultm2 = mysqli_query($conn, "UPDATE moderatori SET blokiran = '$blokiran'  WHERE korIme='$korisnik'");
        echo "Korisnik je uspesno blokiran";
        ?> &nbsp; 
            <a href="admin_block.php">Povratak</a> <?php
    }elseif(isset($rowm['blokiran']) && $rowm['blokiran'] == "DA"){
        $resultm3 = mysqli_query($conn, "UPDATE moderatori SET blokiran = '$odblokiran' WHERE korIme='$korisnik'");
        echo "Korisnik je uspesno odblokiran";
        ?> &nbsp; 
            <a href="admin_block.php">Povratak</a> <?php
    }
    if(!$resultc1 && !$resultm1){
        echo "Greska pri pronalazenju korisnika!";
    }
}
    
