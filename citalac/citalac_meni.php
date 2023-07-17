
<div id="zaglavlje" class="header">
 <?php 
    
        session_start();
     
    include("../dbconnection.php");
    if(isset($_SESSION['citalac'])){ ?>
        <h1>Dobrodošao <?php echo $_SESSION['privilegijec'] . " : ". $_SESSION['citalac']; ?></h1>    
       <?php 
    }
    
    $kor = $_SESSION['citalac'];
    $korUpit = mysqli_query($conn, "SELECT slika from citaoci WHERE korIme='$kor'");
    $rows = mysqli_fetch_assoc($korUpit);
    
    ?></h1>    
</div>
<hr>
<div id="navigacija" class="header">
    <ul>
        <li><a href="citalac_index.php">POCETNA STRANA</a> </li>
        <li class="dropdown"><a>MENI</a>
            <div class="dropdown-sadrzaj">
                <a target="" href="citalac_profil.php">
            <?php
                echo $rows['slika']; 
            ?>
                </a>
                <a href="citalac_pretraga.php">Pretraži knjigu</a>
                <a href="citalac_zahtev.php">Priloži zahtev za novu knjigu</a>
                <a href="citalac_zaduzenja.php">Pogledaj zadužene knjige</a>
                <a href="citalac_istorija.php">Pogledaj istoriju zaduženja</a>
            </div>
        </li>
        <li><a href="citalac_logout.php">Izloguj se</a></li>
    </ul>
</div>
<hr>