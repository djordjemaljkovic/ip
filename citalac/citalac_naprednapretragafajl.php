<?php 
 include("../dbconnection.php");
 $poizdavacu ="";
 $pogodini ="";
 $pozanru ="";
 $rez="";
 $nazivZanra ="";
 $nazivIzdavaca="";
 $zanrString ="";

if(isset($_POST['citalacPretragaPoZanru'])){
    $nazivZanra=$_POST['zanr'];
    foreach ($nazivZanra as $elem){
        $zanrString .= $elem . " ";
    }
    if($nazivZanra==""){ ?>
        <div class="grid-item">
                <div class="grid-item"><?php 
                    
                        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
                    
                    ?></div>
            </div> <?php
    }else{
?>
    <div class="grid-container">
        <div class="grid-item hh">Pretraga po nazivima zanrova: <?php foreach ($nazivZanra as $elem) {
echo $elem . " ";
} ?> </div> <?php
    $pozanru=mysqli_query($conn, "SELECT * FROM knjige WHERE zanr LIKE CONCAT('%','$zanrString','%')");
    if(mysqli_num_rows($pozanru)>0){
            ?>
        <div>
            Rezultati pretrage: </br>
        <?php while($niz=mysqli_fetch_assoc($pozanru)){
            $rez = $niz; ?>
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

if(isset($_POST['citalacPretragaPoGodini'])){
   $godinaod=$_POST['godinaOd'];
   $godinado=$_POST['godinaDo'];
       if($godinaod=="" && $godinado==""){ ?>
        <div class="grid-item">
                <div class="grid-item"><?php 
                    
                        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
                    
                    ?></div>
            </div> <?php
    }else{
    ?>
        <div class="grid-container">
            <div class="grid-item hh">Pretraga po godini izdavanja u periodu: <?php echo $godinaod . " - " . $godinado ?> </div> <?php
    if($godinaod != "" && $godinado == ""){
            $pogodini=mysqli_query($conn, "SELECT * FROM knjige WHERE godinaIzdavanja >= '$godinaod' ");
    }elseif($godinaod == "" && $godinado != ""){
            $pogodini=mysqli_query($conn, "SELECT * FROM knjige WHERE godinaIzdavanja <= '$godinado' ");
    }elseif($godinaod != "" && $godinado !=""){
            $pogodini=mysqli_query($conn, "SELECT * FROM knjige WHERE godinaIzdavanja <= '$godinado' AND godinaIzdavanja >= '$godinaod' ");
    }
    if(mysqli_num_rows($pogodini)>0){
            ?>
        <div>
            Rezultati pretrage: </br>
        <?php while($niz=mysqli_fetch_assoc($pogodini)){
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
}       if(!empty($pogodini)){
        mysqli_free_result($pogodini);
}


if(isset($_POST['citalacPretragaPoIzdavacu'])){
    $nazivIzdavaca=$_POST['izdavac']; 
    if($nazivIzdavaca==""){ ?>
        <div class="grid-item">
                <div class="grid-item"><?php 
                    
                        echo "<span style='color:red'>Nije pronadjen nijedan rezultat!</span>";
                    
                    ?></div>
            </div> <?php
    }else{
?>
    <div class="grid-container">
        <div class="grid-item hh">Pretraga po nazivu izdavaca: <?php echo $nazivIzdavaca ?> </div> <?php
    $poizdavacu=mysqli_query($conn, "SELECT * FROM knjige WHERE izdavac LIKE CONCAT('%','$nazivIzdavaca','%')");
    if(mysqli_num_rows($poizdavacu)>0){
            ?>
        <div>
            Rezultati pretrage: </br>
        <?php while($niz=mysqli_fetch_assoc($poizdavacu)){
            $rez = $niz; ?>
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
            


