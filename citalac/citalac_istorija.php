<link rel="stylesheet" type="text/css" href="../slider.css">
<!--<link rel="stylesheet" type="text/css" href="style.css">-->

<?php 
    include('../dbconnection.php');
    session_start();
    $flag = 0; ?>
        <div class="container"> 
            <div class="slider"> 
                <div class="slider__slides">
                    <h3>Istorija zaduzenih knjiga za korisnika <?php echo $_SESSION['citalac']?></h3>
                    <table>
                        <tr>
                        <th>Knjiga</th>
                        <th>Naziv</th>
                        <th>Autor</th>
                        <th>Datum zaduzivanja</th>
                        <th>Datum vracanja</th>
                        <th>Status</th>
                        </tr>    
                    <?php
    $ime = $_SESSION['citalac'];
    $upit = mysqli_query($conn, "SELECT * FROM zaduzene INNER JOIN knjige on zaduzene.idKnjige = knjige.idKnjige WHERE korIme = '$ime'");
    if(mysqli_num_rows($upit)>0){
        while($row = mysqli_fetch_assoc($upit)){?>
                        <form name='forma' method='POST' action='../knjigaRedirect.php'>
                        <tr>
                            <td><?php echo '<input type="image" src="data:image/jpg;base64,'.base64_encode($row['slika']).'" height="300px" width=auto />'; ?></td>
                            <td><?php echo $row['naziv'];?></td>
                            <td><?php echo $row['autor'];?></td>
                            <td><?php echo $row['datumOd'];?></td>
                            <td><?php echo $row['datumDo'];?></td>
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

               