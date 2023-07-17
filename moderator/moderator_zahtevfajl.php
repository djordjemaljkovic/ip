<?php
    include('../dbconnection.php');

if(isset($_POST['odobri'])){
    $knjiga = $_POST['knjiga'];
    #echo "$korisnik";
    
    $result = mysqli_query($conn, "SELECT * FROM zahtevi WHERE idKnjige ='$knjiga'");
    if(!$result){
        echo "Greska pri pronalazenju knjige!";
    }
    
    while($row = mysqli_fetch_assoc($result)){
        $idKnjige = $row['idKnjige'];
        $naziv = $row['naziv'];
        $autor = $row['autor'];
        $zanr = $row['zanr'];
        foreach ($zanr as $elem){
            $zanrovi.=$elem. " ";
        }
        $izdavac = $row['izdavac'];
        $godinaIzdavanja = $row['godinaIzdavanja'];
        $jezik = $row['jezik'];
        $slika = $row['slika'];
        #$slikaquery = mysqli_query($conn,"SELECT slika FROM pomocna WHERE korIme = '$korisnik'");
        #$rowslika = mysqli_fetch_assoc($slikaquery);
        #$slikaContent = addslashes(file_get_contents($rowslika['slikaquery']));
        #echo "$slikaContent";
        $result1 = mysqli_query($conn, "INSERT INTO knjige (naziv,autor,zanr,izdavac,godinaIzdavanja,jezik,slika) SELECT naziv,autor,zanr,izdavac,godinaIzdavanja,jezik,slika FROM zahtevi WHERE idKnjige = '$idKnjige'");
        $result2 = mysqli_query($conn, "UPDATE knjige SET zanr='$zanrovi' WHERE idKnjige = '$idKnjige'");

        if($result1 && $result2){
            echo "Knjiga je uspesno uneta u sistem!";
            $result3 = mysqli_query($conn, "DELETE FROM zahtevi WHERE idKnjige='$idKnjige'");
            ?> &nbsp; 
            <a href="moderator_zahtev.php">Povratak</a> <?php
        }else{
            echo "Greska pri brisanju knjige!";
        }
        
        #mysqli_free_result($result);
        #mysqli_free_result($result1);
        #mysqli_free_result($result2);
        
        
    }
}



if(isset($_POST['ukloni'])){
    $knjiga = $_POST['knjiga'];
    #echo $knjiga;
    
    $result4 = mysqli_query($conn, "DELETE FROM zahtevi WHERE idknjige='$knjiga'");
    if($result4) {
        echo "Knjiga je uspesno obrisana!";
            ?> &nbsp; 
            <a href="moderator_zahtev.php">Povratak</a> <?php
        }else{
            echo "Greska pri brisanju knjige!";
        }
        
        #mysqli_free_result($result3);
        #mysqli_free_result($result);
        #mysqli_free_result($result1);
        #mysqli_free_result($result2);
        
        
    }



