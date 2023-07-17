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
        <h2>Promeni duzinu zaduzenja knjiga</h2>
        <hr/>
        <h3>Postavite zeljeno trajanje zaduzenja(podrazumevano 14 dana):</h3>
        
        <table>
            <tr>
                <th>Trenutna duzina zaduzenja knjiga</th>
                <th>Zeljena duzina zaduzenja knjiga</th>
            </tr>
            <?php include("../dbconnection.php"); ?>
            <?php                
            $zaduzenje = $_SESSION['zaduzenje']; ?>
                <form name="zaduzenjeforma" method="POST" action="admin_zaduzenjefajl.php">
                    <tr>
                        <th><?php echo $zaduzenje;  ?></th>
                        <th><input type="text" name="zaduzenje" required></th>
                        <th><input type='submit' name="postavi" value="POSTAVI"></th>
                    </tr>
                </form>           
        </table>

        
        
        </div>
        
    </body>
</html>



