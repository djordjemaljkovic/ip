<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div  class="sve">
        <?php include("moderator_meni.php"); ?>
        <h2>Izmeni podatke o profilu</h2>
        <hr/>
        <h3>Lični podaci:</h3>
        
        <table>
            <tr>
                <th></th>
                <th>Ime i prezime</th>
                <th>Adresa</th>
                <th>Telefon</th>
                <th>E-mail adresa</th>
                <th>Slika profila</th>
            </tr>
            <?php include("../dbconnection.php"); ?>
            <?php
                $id = $_SESSION['moderator'];
                $result = mysqli_query($conn, "select korIme,lozinka,imePrezime,adresa,telefon,imejl,slika from moderatori where korIme='$id';");
                if(mysqli_num_rows($result)>0){
                    #session_start(); 
                    while($row = mysqli_fetch_assoc($result)){
                        #setcookie('citalac',$row['korIme']); 
            ?>
            <form name="mojaforma" action="moderator_profilfajl.php" method="POST" enctype="multipart/form-data">
                            <tr>
                                <td>
                                    <input type="hidden" value ="<?php echo $row['korIme'] ?>"
                                           name="idk">
                                </td>
                                <td>
                                        <?php echo $row['imePrezime'] ?></td>
                                <td>
                                        <?php echo $row['adresa'] ?></td>
                                <td>
                                        <?php echo $row['telefon'] ?></td>
                                <td>
                                        <?php echo $row['imejl'] ?></td>
                                <td>
                                        <?php echo $row['slika']; ?></td>
                                <td>    
                                    <input type="hidden" value ="<?php echo $row['lozinka'] ?>"
                                           name="staraloz">
                                </td>
                                <td><input type="submit" name="azurirajpodatkeoprofilu" value="AZURIRAJ PODATKE O PROFILU"></td>
                            </tr>
                        </form>
                        <?php
                    }
                }else{
                    echo "<span style='color:red'>Greska pri promeni informacija o profilu!</span>";
                }
                
                //oslobadjanje resursa
                mysqli_free_result($result);
                //mysqli_close($conn);
                ?>
        </table>

        
        
        </div>
        
    </body>
</html>
