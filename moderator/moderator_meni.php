
<div id="zaglavlje" class="header">
 <?php 
    
        session_start();
     
    include("../dbconnection.php");
    if(isset($_SESSION['moderator'])){ ?>
        <h1>Dobrodošao <?php echo $_SESSION['privilegijem'] . " : ". $_SESSION['moderator']; ?></h1>    
       <?php 
    }
    
    $kor = $_SESSION['moderator'];
    $korUpit = mysqli_query($conn, "SELECT slika from moderatori WHERE korIme='$kor'");
    $rows = mysqli_fetch_assoc($korUpit);
    
    ?></h1>    
</div>
<hr>
<div id="navigacija" class="header">
    <ul>
        <li><a href="moderator_index.php">POCETNA STRANA</a> </li>
        <li class="dropdown"><a>MENI</a>
            <div class="dropdown-sadrzaj">
                <a target="" href="moderator_profil.php">
            <?php
                echo $rows['slika']; 
            ?>
                </a>
                <a href="moderator_dodajknjigu.php">Dodaj knjigu</a>
                <a href="moderator_azurirajknjigu.php">Azuriraj knjigu</a>
                <a href="moderator_pretraga.php">Pretraži knjigu</a>
                <a href="moderator_zahtev.php">Pogledaj zahteve za nove knjige</a>
                <a href="moderator_zaduzenja.php">Pogledaj zadužene knjige</a>
                <a href="moderator_istorija.php">Pogledaj istoriju zaduženja</a>
            </div>
        </li>
        <li><a href="moderator_logout.php">Izloguj se</a></li>
    </ul>
</div>
<hr>