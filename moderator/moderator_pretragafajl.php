<?php 
 include("../dbconnection.php");
 $ponazivu ="";
 $poautoru ="";
 $rez="";

if(isset($_POST['moderatorPretragaPoNazivu'])){
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
            <form action="../knjigaRedirect.php" method="POST">
               
                <input type="image" src="../slike/knjige/<?php echo $niz['slika'];?>" height="100px" width=auto name="slikadugme"/>
                <input type="hidden" value ="<?php echo $niz['idKnjige'] ?>"
                                           name="knjiga">
                </br>
                <p>IdKnjige : <?php echo $rez['idKnjige']?></p>
                <p>Ime knjige : <?php echo $rez['naziv']?></p>
                <p>Autor knjige : <?php echo $rez['autor']?></p>
                <p>Žanr knjige : <?php echo $rez['zanr']?></p>
                <p>Izdavač : <?php echo $rez['izdavac']?></p>
                <p>Godina izdavannja : <?php echo $rez['godinaIzdavanja']?></p>
                <p>Jezik : <?php echo $rez['jezik']?></p>

            
            </form>
            
        </div>
            <?php } 
    }else{
        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
    }
} 
}  

if(isset($_POST['moderatorPretragaPoAutoru'])){
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
            <form name="knjigaforma" action="../knjigaRedirect.php" method="POST">
                <input type="hidden" value ="<?php echo $niz['idKnjige'] ?>"
                                           name="knjiga">
            <input type="image" src="../slike/knjige/<?php echo $niz['slika'];?>" height="100px" width=auto name="slikadugme"/>
            <br>
            <p>IdKnjige : <?php echo $rez['idKnjige']?></p>
            <p>Ime knjige : <?php echo $rez['naziv']?></p>
            <p>Autor knjige : <?php echo $rez['autor']?></p>
            <p>Žanr knjige : <?php echo $rez['zanr']?></p>
            <p>Izdavač : <?php echo $rez['izdavac']?></p>
            <p>Godina izdavannja : <?php echo $rez['godinaIzdavanja']?></p>
            <p>Jezik : <?php echo $rez['jezik']?></p>
            
            </form>
            
        </div>
            <?php } 
    }else{
        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
    }
} 
}
            ?>
        

             
    </div>
            


