<?php 

$errors = array();

if(isset($_POST['logujadmina'])){
    if (empty($_POST['korIme']) || empty($_POST['lozinka'])){
        echo "<span style = 'color:red'>Nisu popunjena sva polja!</span>";
    }else{
        $korIme = $_POST['korIme'];
        $lozinka = $_POST['lozinka'];

        include_once "../dbconnection.php";
        
        $result = mysqli_query($conn, "select * from administratori where ".
                "korIme = '$korIme' and lozinka = '$lozinka'");
        
        if(is_bool($result) == FALSE){
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result); //assoc da bismo mogli normalno da
                                                //pristupamo kolonama normalno kao nizu!!!
                session_start();
                $_SESSION['privilegije']='administrator';
                $_SESSION['administrator']=$row['korIme'];
                $_SESSION['adresa']=$row['adresa'];
                $_SESSION['telefon']=$row['telefon'];
                $_SESSION['imejl']=$row['imejl'];
                $_SESSION['slika']=$row['slika'];
                header('location: admin_index.php');
            }
        }else {
                echo "<span style = 'color:red'>Nisu uneti korektni podaci!</span>";
            }
        } 
        //oslobadjanje resursa samo kada je u pitanju select i kada ne bismo da radimo sa 
        //bazom vise
        if(is_bool($result) == FALSE){
        mysqli_free_result($result);  //samo kad se u $result vraca row
        }
        mysqli_close($conn);          //uvek se radi!!!
        
        }

?>