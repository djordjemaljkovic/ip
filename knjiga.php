<?php 
    include_once("dbconnection.php");
    session_start();
    
//    if(isset($_POST['slikadugme_x'])){
//        $zaduzenik = $_SESSION['citalac'];
//        $_SESSION['id'] = $_POST['knjiga'];
//        $id = $_SESSION['id'];
//    } 
        $id = $_COOKIE['idKnjige'];
        $knjigaupit = mysqli_query($conn, "SELECT * FROM knjige WHERE idKnjige='$id'");
        $knjigarow = mysqli_fetch_assoc($knjigaupit);

        if($knjigarow['ocena'] == 0){
            $ocena = "Knjiga jos nije ocenjivana!";
        }else{
            $ocena = $knjigarow['ocena'];
        }
        $nastanju = $knjigarow['tiraz'] - $knjigarow['zaduzeno'];
    
    
    
 
?>



<html>
    <head>
        <title>Knjiga</title>
    </head>
    <body>
        <table width="100%">
            <tr>
                <td colspan="2" align="center">Informacije o knjizi sa rednim brojem <?php echo " ". $id; ?></td>
            </tr>
            <tr>
                <td width="70%" height="600px" >
                    <h3>Osnovne informacije o knjizi:</h3>
                    <form method="POST" action="">
                        <ul>
                            <input type="hidden" value="<?php echo $knjigarow['idKnjige'];?>" name="knjigazaduzi"/>
                            <input type="hidden" value="<?php
                                        if(!empty($_SESSION['citalac'])){echo $_SESSION['citalac'];}
                                        if(!empty($_SESSION['moderator'])){echo $_SESSION['moderator'];}?>" name="korisnikzaduzi"/>
                            <input type="hidden" value="<?php echo $nastanju;?>" name="stanje"/>

                            <li>
                                Naziv knjige: <?php echo $knjigarow['naziv'] ?>
                            </li>
                            <li>
                                Autor knjige: <?php echo $knjigarow['autor'] ?>
                            </li>
                            <li>
                                Zanr: <?php echo $knjigarow['zanr'] ?>
                            </li>
                            <li>
                                Izdavač: <?php echo $knjigarow['izdavac'] ?>
                            </li>
                            <li>
                                Godina izdavanja: <?php echo $knjigarow['godinaIzdavanja'] ?>
                            </li>
                            <li>
                                Jezik: <?php echo $knjigarow['jezik'] ?>
                            </li>
                            <li>
                                Na stanju komada: <?php echo $nastanju ?>
                            </li>
                            <li>
                                Prosecna ocena: <?php echo $ocena ?>
                            </li>
                        </ul>
                    </br>
                    <input type="submit" name="zaduzi" value="ZADUZI KNJIGU">
                    
                    </form>
                    <?php if(!empty($_SESSION['citalac'])){
                        echo "<a href='citalac/citalac_pretraga.php'>Vratite se na pretragu knjiga</a>";
                    }else{
                        echo "<a href='moderator/moderator_pretraga.php'>Vratite se na pretragu knjiga</a>";
                    } ?>
                </td>
                <td width="30%" height="600px" >
                    <h3>Slika korice knjige:</h3>
                        <img src="slike/knjige/<?php echo $knjigarow['slika'];?>" height="200px" width=auto/>
                </td>
            </tr>
            <tr>
                <td colspan="2" align='center'>Elektronska biblioteka</td>
            </tr>
        </table>
    </body>
</html>


<?php
    

   if(isset($_POST['zaduzi'])){
        $citalac =""; $moderator ="";
        $knjiga = $_POST['knjigazaduzi'];
        $korisnik = $_POST['korisnikzaduzi'];
        $stanje = $_POST['stanje'];
        $zaduzene = array();
        if(!empty($_SESSION['citalac'])){
        $citalac = $_SESSION['citalac'];
        }else{
            $moderator = $_SESSION['moderator'];
        }
        $flag = 0;
        
        $zaduzenjeupit = mysqli_query($conn, "SELECT korIme FROM zaduzene WHERE idKnjige='$knjiga'");
        $zaduzenerownums = mysqli_num_rows($zaduzenjeupit);
        $ostalazaduzenja = mysqli_query($conn, "SELECT * FROM zaduzene WHERE korIme='$korisnik'");
        $ostalazaduzenjarownums = mysqli_num_rows($ostalazaduzenja);
        while($zaduzenerow = mysqli_fetch_assoc($zaduzenjeupit)){
            array_push($zaduzene,$zaduzenerow);
        }
        foreach($zaduzene as $value){
            if(($value['korIme'] == $citalac) || ($value['korIme'] == $moderator)) $flag = 1;
        }
        
        if($stanje >0){
            if($zaduzenerownums == 0 || !$flag){
                if($ostalazaduzenjarownums < 3){
                    $datumOd  = date("Y-m-d");
                    $datumOdSek = strtotime($datumOd);
                    $_SESSION['datumod'] = $datumOdSek;
                    $status = "zaduzeno";
                    $zaduzi = mysqli_query($conn, "INSERT INTO zaduzene(korIme,idKnjige,datumOd,status) VALUES ('$korisnik','$knjiga','$datumOd','$status')");
                    echo "</br>"; echo "<span style='color:green'>Knjiga je uspesno zaduzena!</span>";  
                    $brojzaduzenih = mysqli_query($conn, "SELECT * FROM knjige WHERE idKnjige='$knjiga'");
                    $row = mysqli_fetch_assoc($brojzaduzenih);
                    $zaduzeno = $row['zaduzeno'] +1;
                    $primerci = $row['tiraz'] -1 ;
                    $uzeto = mysqli_query($conn, "UPDATE knjige SET zaduzeno='$zaduzeno',tiraz='$primerci' WHERE idKnjige='$knjiga'");
                }else{
                echo "<br/>";
                echo "<span style='color:red'>Maksimalan broj knjiga je vec zaduzen!</span>";  
                }
            }else{
                echo "<br/>";
                echo "<span style='color:red'>Knjiga je vec zaduzena!</span>";
                $flag = 0;
            }
        }else{
            echo "<br/>";
            echo "<span style='color:red'>Knjige nema na stanju!</span>";
        }
   }
?>


