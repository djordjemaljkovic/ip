
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div  class="sve">
        <?php include("admin_meni.php"); ?>
        <h2>Azuriraj postojece knjige</h2>
        <hr/>
        <h3>Knjige elektronske biblioteke:</h3>
        
        <table>
            <tr>
                <th></th>
                <th>Naziv knjige</th>
                <th>Autor </th>
                <th>Zanr</th>
                <th>Izdavac</th>
                <th>Godina izdavanja</th>
                <th>Jezik</th>
                <th>Slika</th>
                <th>Tiraz</th>

            </tr>
            <?php include("../dbconnection.php"); ?>
            <?php
                $result = mysqli_query($conn, "select idKnjige,naziv,autor,zanr,izdavac,godinaIzdavanja,jezik,slika,tiraz from knjige");
                if(mysqli_num_rows($result)>0){
                    #session_start(); 
                    while($row = mysqli_fetch_assoc($result)){
                        $knjigaid = $row['idKnjige'];
            ?>
                        <form name="mojaforma" action="admin_knjige_azurfajl.php" method="POST">
                            <tr>
                                <td>
                                    <input type="hidden" value ="<?php echo $row['idKnjige'] ?>"
                                           name="idk">
                                </td>
                                <td><?php echo $row['naziv'] ?></td>
                                <td><?php echo $row['autor'] ?></td>
                                <td><?php echo $row['zanr'] ?></td>
                                <td><?php echo $row['izdavac'] ?></td>
                                <td><?php echo $row['godinaIzdavanja'] ?></td>
                                <td><?php echo $row['jezik'] ?></td>
                                <td><img src="../slike/knjige/<?php echo $row['slika']?>" height="100px" width="auto"></td>
                                <td><?php echo $row['tiraz'] ?></td>
                                <td><input type="submit" name="azuriraj" value="AZURIRAJ PODATKE O KNJIZI"></td>
                            </tr>
                        </form>
                        <?php 
                    }
                }else{
                    echo "Ne postoji nijedan korisnik elektronske biblioteke!";
                }
                
                //oslobadjanje resursa
                mysqli_free_result($result);
                //mysqli_close($conn);
                ?>
        </table>

        
        
        </div>
        
    </body>
</html>



