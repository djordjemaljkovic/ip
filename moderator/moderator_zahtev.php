<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div  class="sve">
        <?php include("moderator_meni.php"); ?>
        <h2>Dodaj zahtev za knjigu</h2>
        <hr/>
        <h3>Zahtevi na čekanju:</h3>
        
        <table>
            <tr>
                <th>Naziv</th>
                <th>Autor</th>
                <th>Zanr</th>
                <th>Izdavac</th>
                <th>Godina izdavanja</th>
                <th>Jezik</th>
                <th>Slika</th>
            </tr>
            <?php include("../dbconnection.php"); ?>
            <?php
                $result = mysqli_query($conn, "select * FROM zahtevi");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        $slicica = $row['slika'];
            ?>
                        <form name="mojaforma" action="moderator_zahtevfajl.php" method="POST">
                            <tr>
                                <td>
                                    <input type="hidden" value ="<?php echo $row['idKnjige'] ?>"
                                           name="knjiga">
                                </td>
                                <td><?php echo $row['autor']; ?></td>
                                <td><?php echo $row['zanr']; ?></td>
                                <td><?php echo $row['izdavac'];?></td>
                                <td><?php echo $row['godinaIzdavanja']; ?></td>
                                <td><?php echo $row['jezik']; ?></td>
                                <td><?php echo "<img src='../slike/knjige/<?php echo '$slicica';?>' height='100px' width=auto/>"; ?></td>
                                <td><input type="submit" name="odobri" value="PRIHVATI ZAHTEV"></td>
                                <td><input type="submit" name="ukloni" value="ODBIJ ZAHTEV"></td>
                            </tr>
                        </form>
                        <?php
                    }
                }else{
                    echo "Nema zahteva na čekanju!";
                }
                
                //oslobadjanje resursa
                mysqli_free_result($result);
                //mysqli_close($conn);
                ?>
        </table>

        
        
        </div>
        
    </body>
</html>

