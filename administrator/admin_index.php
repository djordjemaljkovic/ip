
<?php
session_start();
if(!empty($_SESSION['administrator'])){
    ?>
    
        <div id="zaglavlje" class="header">
            <h1>Dobrodošao <?php echo $_SESSION['privilegijea'] . " : ". $_SESSION['administrator']; ?></h1>    
        </div>
        <hr>
        <div id="navigacija" class="header">
            <ul>
                <li><a href="admin_index.php">NASLOVNA</a> </li>
                <li class="dropdown"><a>KORISNICI</a>
                    <div class="dropdown-sadrzaj">
                        <a href="admin_dodaj.php">Dodaj korisnika</a>
                        <a href="admin_obrisi.php">Obrisi korisnika</a>
                                        <a href="admin_izmeni.php">Promeni privilegiju korisniku</a>
                                        <a href="admin_block.php">Blokiraj/odblokiraj korisnika</a>
                    </div>
                </li>
                <li class="dropdown"><a>KNJIGE</a>
                    <div class="dropdown-sadrzaj">
                        <a href="admin_knjige_dodaj.php">Dodaj knjigu</a>
                        <a href="admin_knjige_azur.php">Azuriraj knjigu</a>
                        <a href="admin_knjige_obrisi.php">Obrisi knjigu</a>
                    </div>
                </li>
                <li><a href="admin_zaduzenje.php">Duzina trajanja zaduzenja knjige</a></li>
                <li><a href="admin_logout.php">IZLOGUJ SE</a></li>

            </ul>
        </div>
        <hr>
    <?php
    include('admin_pocetna.php'); 
}else{
    echo "<span style='color:red'>Nemate pristup, napustite stranicu!</span>";
}
?>