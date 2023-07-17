<link rel="stylesheet" type="text/css" href="../slider.css">
<!--<link rel="stylesheet" type="text/css" href="style.css">-->

<?php 
    include('../dbconnection.php');
    session_start();
    var_dump($_SESSION);
    $flag = 0; ?>
        <div class="container"> 
            <div class="slider"> 
                <div class="slider__slides"><?php
    $ime = $_SESSION['citalac'];
    $upit = mysqli_query($conn, "SELECT * FROM zaduzene INNER JOIN knjige on zaduzene.idKnjige = knjige.idKnjige WHERE korIme = '$ime' AND status ='zaduzeno'");
    if(mysqli_num_rows($upit)>0){
        while($row = mysqli_fetch_assoc($upit)){ if(!$flag){?>
            <div class="slider__slide active"> <?php $flag = 1; ?>
                <img src="../slike/knjige/<?php echo $row['slika'];?>" height="200px" width=auto/>
                
            </div>
        <?php
        }else{
            ?>
            <div class="slider__slide"> 
                <img src="../slike/knjige/<?php echo $row['slika'];?>" height="200px" width=auto/>
            </div>
        <?php
        }              
    }
    $flag = 0;  ?>
                    </div>
                <div id="nav-button--prev" class="slider__nav-button"></div>
                <div id="nav-button--next" class="slider__nav-button"></div>
        </div>
    </div> 
       
<script src="../slider.js"></script>
    <?php
    }else{
        ?> <h2 style='color:red' align='center'>Korisnik nema zaduzenih knjiga!</h2> <?php
    }
?>
                
    


