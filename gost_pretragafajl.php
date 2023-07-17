<link rel="stylesheet" type="text/css" href="style.css">
<div id="zaglavlje" class="header">
            <h1>Dobrodošli na elektronsku biblioteku</h1>
        </div>
        <hr>
        <div id="navigacija" class="header">
            <ul>
                <li>&nbsp;</li>
                <li><a href="login.php">ULOGUJ SE</a></li>
                <li>&nbsp;</li>
                <li><a href="register.php">REGISTRUJ SE</a></li>
                <li>&nbsp;</li>
                <li><a href="gost_index.php">VRATI SE NA POCETNU STRANU</a></li>
            </ul>
        </div>
        <hr>

<?php 
 include("dbconnection.php");
 $ponazivu ="";
 $poautoru ="";
 $rez="";

if(isset($_POST['gostPretragaPoNazivu'])){
    $imeKnjige=$_POST['imeKnjige']; 
    if($imeKnjige==""){ ?>
        <div class="grid-item">
                <div class="grid-item"><?php 
                    
                        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
                    
                    ?></div>
            </div> <?php
    }else{
?>
    <div class="grid-container">
        <div class="grid-item hh">Pretraga po nazivu knjige: <?php echo $imeKnjige ?> </div> <?php
    $ponazivu=mysqli_query($conn, "SELECT * FROM knjige WHERE naziv LIKE CONCAT('%','$imeKnjige','%')");
    if(mysqli_num_rows($ponazivu)>0){
            ?>
        <div>
            Rezultati pretrage: </br>
        <?php while($niz=mysqli_fetch_assoc($ponazivu)){
            $rez = $niz; ?>
            <form action="knjigaRedirect.php" method="POST">
                <?php
            echo '<input type="image" src="data:image/jpg;base64,'.base64_encode($niz['slika']).'" height="100px" width=auto name="slikadugme"/>'; ?>
                <input type="hidden" value ="<?php echo $niz['idKnjige'] ?>"
                                           name="knjiga">
                </br>
            <?php
            $rez['slika'] = "";
            foreach ($rez as $elem){
            echo nl2br($elem . " "); }
            echo "<br>";
            echo $niz['idKnjige'];
            ?>
            </form>
            
        </div>
            <?php } 
    }else{
        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
    }
} 
}  

if(isset($_POST['gostPretragaPoAutoru'])){
   $autor=$_POST['pisacKnjige'];
       if($autor==""){ ?>
        <div class="grid-item">
                <div class="grid-item"><?php 
                    
                        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
                    
                    ?></div>
            </div> <?php
    }else{
    ?>
        <div class="grid-container">
            <div class="grid-item hh">Pretraga po imenu autora: <?php echo $autor ?> </div> <?php
    $poautoru=mysqli_query($conn, "SELECT * FROM knjige WHERE autor LIKE CONCAT('%','$autor','%')");
    if(mysqli_num_rows($poautoru)>0){
            ?>
        <div>
            Rezultati pretrage: </br>
        <?php while($niz=mysqli_fetch_assoc($poautoru)){
            $rez = $niz ?>
            <form name="knjigaforma" action="knjigaRedirect.php" method="POST">
                <input type="hidden" value ="<?php echo $niz['idKnjige'] ?>"
                                           name="knjiga">
                
            <?php
            echo '<input type="image" src="data:image/jpg;base64,'.base64_encode($niz['slika']).'" height="100px" width=auto name="slikadugme"/>'; ?>
            </form>
            <?php
            $rez['slika'] = "";
            foreach($rez as $elem){
            echo nl2br($elem . " "); }
            echo "<br>";?>
        </div>
            <?php } 
    }else{
        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
    }
} 
}
            ?>
        

             
    </div>
            


