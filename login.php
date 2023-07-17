<?php 

include('dbconnection.php');



#session_start();

if(isset($_POST['loguj'])){
        $flag=0;
        $errors = array();
        $korIme = $_POST['korIme'];
        $lozinka = $_POST['lozinka'];
        $md5 = md5($lozinka);
        $upit1 = "SELECT * FROM administratori";
        $upit2 = "SELECT * FROM moderatori";
        $upit3 = "SELECT * FROM citaoci";
        $rez1 = mysqli_query($conn,$upit1);
        $rez2 = mysqli_query($conn,$upit2);
        $rez3 = mysqli_query($conn,$upit3);
        if(empty($korIme)){
            $errors['korIme'] = "Polje za korisnicko ime je prazno!";
        }
        if(empty($lozinka)){
            $errors['lozinka']= "Polje za lozinku je prazno!";
        }
        if(count($errors)==0){
            while($row2 = mysqli_fetch_assoc($rez2))
                {   
                    if($row2['korIme']=="$korIme" && $row2['lozinka']=="$md5" && $row2['blokiran']=="NE")
                    {
                        
                            session_start();
                            $_SESSION['privilegijem']='moderator';
                            $_SESSION['moderator']=$row2['korIme'];

                            header("Location: moderator/moderator_index.php");
                            echo "Ispravna lozinka";
                            $flag=1;
                        }
                        else 
                        {
                            $errors['lozinka']= "Neispravna lozinka/korisnicko ime ili je korisnik blokiran!";
                        }
                    }
                }
            while($row3 = mysqli_fetch_assoc($rez3))
                {  
                    if($row3['korIme']=="$korIme" && $row3['lozinka']=="$md5" && $row3['blokiran']=="NE")
                    {
                            session_start();
                            $_SESSION['privilegijec']='citalac';
                            $_SESSION['citalac']=$row3['korIme'];

                            header("Location: citalac/citalac_index.php");
                            echo "Ispravna lozinka";
                            $flag=1;
                        }
                        else 
                        {
                            $errors['lozinka']= "Neispravna lozinka/korisnicko ime ili je korisnik blokiran!";
                        }
                    }
                }        
    

#raskidanje veze sa serverom
$conn->close();
?>




<html>
<head>
    <title>Log in</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    

</head>
<body>
    <div  class="sve">
        <?php include("zaglavlje_index.php"); ?>
            <form action="" method="POST">
                <?php
                include_once('errors.php') ?>
                <table  class="sve nav">
                    <th colspan="2">
                    
                        ULOGUJTE SE
                   
                    </th>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Korisničko ime :
                        </td>
                        <td>
                            <input type='text' name='korIme' required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Lozinka :
                        </td>
                        <td>
                            <input type='password' name='lozinka' required/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            <input class="dugme" type="submit" value="Uloguj se" name="loguj"/>
                            <input class="dugme" type="reset" value="Poništi"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nemate nalog?
                        </td>
                        <td>
                            <a href="register.php"><b>REGISTRUJTE SE</b></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            &nbsp;
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                </table>
        </form>
    </div>


</body>
</html>
