<?php 

include('dbconnection.php');
$flag=0;
$errors = array();
session_start();

if(isset($_POST['loguj'])){
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
                        
                            
                            $_SESSION['privilegije']='moderator';
                            $_SESSION['moderator']=$row2['korIme'];
                            $_SESSION['adresa']=$row2['adresa'];
                            $_SESSION['telefon']=$row2['telefon'];
                            $_SESSION['imejl']=$row2['imejl'];
                            $_SESSION['slika']=$row2['slika'];

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
                        
                            $_SESSION['korIme']= $row3['korIme'];
                            $_SESSION['privilegije']='moderator';
                            $_SESSION['citalac']=$row3['korIme'];
                            $_SESSION['adresa']=$row3['adresa'];
                            $_SESSION['telefon']=$row3['telefon'];
                            $_SESSION['imejl']=$row3['imejl'];
                            $_SESSION['slika']=$row3['slika'];

                            header("Location: citalac/citalac_index.php");
                            echo "Ispravna lozinka";
                            $flag=1;
                        }
                        else 
                        {
                            $errors['lozinka']= "Neispravna lozinka/korisnicko ime ili je korisnik blokiran!";
                            include_once('errors.php');
                        }
                    }
                }        
    
    if($flag == 0) {
    header("Location:login.php");
    }

echo 10;
#raskidanje veze sa serverom
$conn->close();
?>