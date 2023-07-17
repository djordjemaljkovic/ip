<?php

    include('dbconnection.php');
    $knjiga = $_POST['knjiga'];
    $korisnik = $_POST['korisnik'];
    $stanje = $_POST['stanje'];
    

   if(isset($_POST['zaduzi'])){
        session_start();
        $knjiga = $_POST['knjiga'];
        $korisnik = $_POST['korisnik'];
        
        $zaduzenjeupit = mysqli_query($conn, "SELECT korIme FROM zaduzene WHERE idKnjige='$knjiga'");
        $zaduzenerownums = mysqli_num_rows($zaduzenjeupit);
        $ostalazaduzenja = mysqli_query($conn, "SELECT * FROM zaduzene WHERE korIme='$korisnik'");
        $ostalazaduzenjarownums = mysqli_num_rows($ostalazaduzenja);
        $zaduzenerow = mysqli_fetch_assoc($zaduzenjeupit); 
        
    
        if($stanje >0){
            if($zaduzenerownums == 0 || ($zaduzenerow['korIme'] != $_SESSION['korIme'])){
                if($ostalazaduzenjarownums < 3){
                    $zaduzi = mysqli_query($conn, "INSERT INTO zaduzene(korIme,idKnjige) VALUES ('$korisnik','$knjiga')");
                    echo "</br>"; echo "<span style='color:green'>Knjiga je uspesno zaduzena!</span>";  
                    $brojzaduzenih = mysqli_query($conn, "SELECT zaduzeno FROM knjige WHERE idKnjige='$knjiga'");
                    $row = mysqli_fetch_assoc($brojzaduzenih);
                    $zaduzeno = $row['zaduzeno'] +1;
                    $uzeto = mysqli_query($conn, "UPDATE knjige SET zaduzeno='$zaduzeno' WHERE idKnjige='$idKnjige'");
                }else{
                echo "<br/>";
                echo "<span style='color:red'>Maksimalan broj knjiga je vec zaduzen!</span>";  
                }
            }else{
                echo "<br/>";
                echo "<span style='color:red'>Knjiga je vec zaduzena!</span>";
            }
        }else{
            echo "<br/>";
            echo "<span style='color:red'>Knjige nema na stanju!</span>";
        }
   }
?>
