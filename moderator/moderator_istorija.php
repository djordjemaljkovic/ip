<link rel="stylesheet" type="text/css" href="../slider.css">
<!--<link rel="stylesheet" type="text/css" href="style.css">-->

<?php 
    include('../dbconnection.php');
    session_start();
    $flag = 0; ?>
        <div class="container"> 
            <div class="slider"> 
                <div class="slider__slides">
                    <h3>Istorija zaduzenih knjiga za korisnika <?php echo $_SESSION['moderator']?></h3>
                    <table>
                        <tr>
                        <th>Knjiga</th>
                        <th>Naziv</th>
                        <th>Autor</th>
                        <th>Datum zaduzivanja</th>
                        <th>Status</th>
                        </tr>    
                    <?php
    $ime = $_SESSION['moderator'];
    $upit = mysqli_query($conn, "SELECT * FROM zaduzene INNER JOIN knjige on zaduzene.idKnjige = knjige.idKnjige WHERE korIme = '$ime'");
    if(mysqli_num_rows($upit)>0){
        while($row = mysqli_fetch_assoc($upit)){ 
            $od = $row['datumOd'];
            $odsek = strtotime($od);
            $sad = date("Y-m-d");
            $sadsek = strtotime($sad);
            $zad = $_SESSION['zaduzenje']*24*60*60;
            $do = $sadsek - $odsek;
            $doDan = ($zad/(24*60*60)) - ($do/(24*60*60));
            if($do > $zad){
                $doDan = -$doDan;
                $status = "kasni " . $doDan . " dana!"; 
                $upitok =mysqli_query($conn, "UPDATE zaduzene SET status='$status' WHERE korIme='$ime'"); 
            }else{
                $status = "vraca za " . $doDan . " dana!";
                $upitneok =  mysqli_query($conn, "UPDATE zaduzene SET status='$status' WHERE korIme='$ime'" );
            }
            $slicica = $row['slika'];?>
                        <form name='forma' method='POST' action='../knjigaRedirect.php'>
                        <tr>
                            <td><img src='../slike/knjige/<?php echo '$slicica';?>' height='100px' width=auto/></td>
                            <td><?php echo $row['naziv'];?></td>
                            <td><?php echo $row['autor'];?></td>
                            <td><?php echo $row['datumOd'];?></td>
                            <td><?php echo $row['status'];?></td>
                            <td><input type='hidden' value='<?php echo $row['idKnjige'];?>' name='izabrana'/></td>
                        </tr>
                        </form>
                </div>
        <?php
        }              
    }else{
        ?> <h2 style='color:red' align='center'>Korisnik nije zaduzivao nijednu knjigu!</h2> <?php
    }
    ?> </div>
        </div>
</div>

               