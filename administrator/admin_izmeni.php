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
        <?php include("admin_meni.php"); ?>
        <h2>Promeni privilegiju korisniku</h2>
        <hr/>
        <h3>Korisnici elektronske biblioteke:</h3>
        
        <table>
            <tr>
                <th>Korisnicko ime</th>
                <th>Ime i prezime</th>
                <th>Adresa</th>
                <th>Telefon</th>
                <th>Mejl adresa</th>
                <th>Slika</th>
            </tr>
            <?php include("../dbconnection.php"); ?>
            <?php
                $result = mysqli_query($conn, "select korIme,imePrezime,adresa,telefon,imejl,slika from moderatori UNION select korIme,imePrezime,adresa,telefon,imejl,slika from citaoci ");
                if(mysqli_num_rows($result)>0){
                    while($row = mysqli_fetch_assoc($result)){
                        $pripadnost = "";
                        $covek = $row['korIme'];
                        $ucitaocima = mysqli_query($conn, "SELECT * FROM citaoci WHERE korIme='$covek'");
                        $rezcit = mysqli_fetch_assoc($ucitaocima);
                        if(!empty($rezcit)){
                            $pripadnost = "citalac";
                        }else{
                            $pripadnost = "moderator";
                        }
            ?>             
                        <form name="mojaforma" action="admin_izmenifajl.php" method="POST">
                            <tr>
                                <td><?php echo $row['korIme'] ?>
                                    <input type="hidden" value ="<?php echo $row['korIme'] ?>"
                                           name="korisnik">
                                </td>
                                <td><?php echo $row['imePrezime'] ?></td>
                                <td><?php echo $row['adresa'] ?></td>
                                <td><?php echo $row['telefon'] ?></td>
                                <td><?php echo $row['imejl'] ?></td>
                                <td><?php echo $row['slika'] ?></td>
                                <td><?php echo $pripadnost ?></td>
                                <td><input type="submit" name="izmeni" value="PROMENI PRIVILEGIJU KORISNIKA"></td>
                            </tr>
                        </form>
                        <?php
                    }
                }else{
                    echo "Ne postoji nijedan korisnik biblioteke!";
                }
                
                //oslobadjanje resursa
                mysqli_free_result($result);
                //mysqli_close($conn);
                ?>
        </table>

        
        
        </div>
        
    </body>
</html>



