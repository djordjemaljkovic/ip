<link rel="stylesheet" type="text/css" href="../slider.css">
<link rel="stylesheet" type="text/css" href="style.css">

<table width="100%">
    <tr>
        <td width="60%" height =600px>
            <div class="container">
                <div class="slider">
                    <div class="slider__slides">
                        <div class="slider__slide active">
                            <h3>Top 3 knjige po Vašem izboru:</h3>
                        </div>
                        <?php 
                            include('../dbconnection.php');
                            #session_start();

                            $top3 = mysqli_query($conn, "SELECT * FROM knjige ORDER BY zaduzeno DESC LIMIT 3");
                            if(mysqli_num_rows($top3)>0){
                                while($row = mysqli_fetch_assoc($top3)){
                                    ?>
                                    <div class="slider__slide">
                                       <img src="../slike/knjige/<?php echo $row['slika'];?>" height="100%" width=auto/>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <div id="nav-button--prev" class="slider__nav-button"></div>
                    <div id="nav-button--next" class="slider__nav-button"></div>
                    <div class="slider__nav">
                        <div class="slider__navlink active"></div>
                        <?php 
                        $top2 = mysqli_query($conn, "SELECT * FROM knjige ORDER BY zaduzeno DESC LIMIT 2");
                            if(mysqli_num_rows($top2)>0){
                                while($row = mysqli_fetch_assoc($top2)){
                                    ?>
                            <div class="slider__navlink"></div> <?php }} ?>
                    </div>
                </div>
            </div>
        </td>
<script src="../slider.js"></script>

        <td width="40%" height="600px" >
            <div class="container" id="bookofday">
                    <div id="displayimage">
                        <?php 
                            include('../dbconnection.php');
                            $result = mysqli_query($conn, "SELECT slika,naziv,autor,ocena FROM knjige ORDER BY RAND() LIMIT 1");
                            while($row = mysqli_fetch_assoc($result)){
                                ?>
                        <br><br><br><br><br>
                        <h3 align ="center">Knjiga dana:</h3>
                                <img src="../slike/knjige/<?php echo $row['slika'];?>" height="400px" width=auto/>
                        </br>
                        <ul>
                            <li>Ime knjige: <?php echo $row['naziv']; ?></li>   
                        </br>
                            <li>Autor : <?php echo $row['autor']; ?></li>
                        </br>
                            <li>Prosečna ocena: <?php echo $row['ocena']; ?></li>
                        </ul>            
                         <?php   }
                                ?> 
                    </div>
            </div>
        </td>
    </tr>
</table>